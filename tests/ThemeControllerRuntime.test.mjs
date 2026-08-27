import assert from 'node:assert/strict'
import { readFileSync } from 'node:fs'
import test from 'node:test'

const template = readFileSync('resources/views/components/app/theme-controller.blade.php', 'utf8')
const source = template.match(/<script data-theme-controller>([\s\S]*?)<\/script>/)?.[1]

if (!source) {
    throw new Error('Theme controller script could not be found.')
}

class ClassList {
    #classes = new Set()

    contains(name) {
        return this.#classes.has(name)
    }

    toggle(name, force) {
        if (force) {
            this.#classes.add(name)
        } else {
            this.#classes.delete(name)
        }

        return this.contains(name)
    }
}

function bootThemeController({ storedTheme = null, throwOnRead = false, throwOnWrite = false } = {}) {
    const classList = new ClassList()
    const documentListeners = new Map()
    const writes = []
    const listeners = new Map()
    let matchMediaCalls = 0
    let navigationListenerRegistrations = 0

    const window = {
        localStorage: {
            getItem() {
                if (throwOnRead) {
                    throw new Error('Storage is unavailable.')
                }

                return storedTheme
            },
            setItem(key, value) {
                if (throwOnWrite) {
                    throw new Error('Storage is unavailable.')
                }

                writes.push([key, value])
            },
        },
        matchMedia() {
            matchMediaCalls += 1

            return { matches: true }
        },
        addEventListener(name, listener) {
            listeners.set(name, listener)
        },
        dispatchEvent(event) {
            listeners.get(event.type)?.(event)
        },
    }
    const document = {
        documentElement: { classList },
        addEventListener(name, listener) {
            if (name === 'livewire:navigating') {
                navigationListenerRegistrations += 1
            }

            documentListeners.set(name, listener)
        },
    }
    const Event = class {
        constructor(type) {
            this.type = type
        }
    }

    const executeThemeController = () => new Function('window', 'document', 'Event', source)(window, document, Event)

    executeThemeController()

    return {
        classList,
        controller: window.themeController(),
        executeThemeController,
        matchMediaCalls,
        navigationListenerRegistrations: () => navigationListenerRegistrations,
        navigate(detail) {
            documentListeners.get('livewire:navigating')?.({ detail })
        },
        window,
        writes,
    }
}

test('the missing preference resolves to light without consulting the system theme', () => {
    const theme = bootThemeController()

    assert.equal(theme.classList.contains('dark'), false)
    assert.equal(theme.controller.theme, 'light')
    assert.equal(theme.matchMediaCalls, 0)
})

test('the stored light and dark preferences resolve to their matching root state', () => {
    const light = bootThemeController({ storedTheme: 'light' })
    const dark = bootThemeController({ storedTheme: 'dark' })

    assert.equal(light.classList.contains('dark'), false)
    assert.equal(dark.classList.contains('dark'), true)
    assert.equal(dark.controller.theme, 'dark')
})

for (const value of ['system', 'auto', 'foo', '', 'null']) {
    test(`the invalid ${JSON.stringify(value)} preference resolves to light`, () => {
        const theme = bootThemeController({ storedTheme: value })

        assert.equal(theme.classList.contains('dark'), false)
        assert.equal(theme.controller.theme, 'light')
        assert.deepEqual(theme.writes, [])
    })
}

test('the toggle updates the root state, persisted preference, and other theme controls', () => {
    const theme = bootThemeController()
    const settingsController = theme.window.themeController()

    theme.window.addEventListener('theme-changed', () => settingsController.sync())

    theme.controller.toggle()

    assert.equal(theme.classList.contains('dark'), true)
    assert.equal(theme.controller.theme, 'dark')
    assert.equal(settingsController.theme, 'dark')
    assert.deepEqual(theme.writes, [['theme', 'dark']])

    theme.controller.toggle()

    assert.equal(theme.classList.contains('dark'), false)
    assert.equal(theme.controller.theme, 'light')
    assert.equal(settingsController.theme, 'light')
    assert.deepEqual(theme.writes, [['theme', 'dark'], ['theme', 'light']])
})

test('storage read and write failures preserve a usable light-or-dark current page state', () => {
    const unreadable = bootThemeController({ throwOnRead: true })
    const unwritable = bootThemeController({ throwOnWrite: true })

    assert.equal(unreadable.classList.contains('dark'), false)

    unwritable.controller.setTheme('dark')

    assert.equal(unwritable.classList.contains('dark'), true)
    assert.equal(unwritable.controller.theme, 'dark')
    assert.deepEqual(unwritable.writes, [])
})

test('Livewire navigation restores the root state during the documented onSwap lifecycle', () => {
    const theme = bootThemeController({ storedTheme: 'dark' })
    let onSwap

    theme.classList.toggle('dark', false)
    theme.navigate({ onSwap(callback) { onSwap = callback } })
    onSwap()

    assert.equal(theme.classList.contains('dark'), true)

    theme.executeThemeController()

    assert.equal(theme.navigationListenerRegistrations(), 1)
})
