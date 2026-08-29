<x-playground.layout :title="__('Input')" :description="__('Primitive input dan form untuk membangun form yang accessible dan reusable.')" current="components.input">
  {{-- =====================================================================
         SECTION: INPUT
         ===================================================================== --}}
  <section class="flex flex-col gap-4" aria-labelledby="input-heading">
    <div class="flex flex-col gap-1">
      <x-ui.heading id="input-heading" variant="section">Input</x-ui.heading>
      <x-ui.heading variant="description">{{ __('Input native meneruskan seluruh atribut HTML, wire:*, dan x-* secara transparan.') }}</x-ui.heading>
    </div>

    <x-ui.card>
      <x-ui.card.content class="flex flex-col gap-5 pt-6">
        <div class="grid gap-4 sm:grid-cols-2">
          <x-ui.field>
            <x-ui.label for="demo-default">Default</x-ui.label>
            <x-ui.input id="demo-default" name="demo_default" placeholder="Enter text…" />
          </x-ui.field>

          <x-ui.field>
            <x-ui.label for="demo-email">Email</x-ui.label>
            <x-ui.input id="demo-email" name="demo_email" type="email" placeholder="you@example.com" />
          </x-ui.field>

          <x-ui.field>
            <x-ui.label for="demo-password">Password</x-ui.label>
            <x-ui.input id="demo-password" name="demo_password" type="password" placeholder="••••••••" autocomplete="new-password" />
          </x-ui.field>

          <x-ui.field>
            <x-ui.label for="demo-number">Number</x-ui.label>
            <x-ui.input id="demo-number" name="demo_number" type="number" placeholder="0" min="0" step="1" />
          </x-ui.field>

          <x-ui.field>
            <x-ui.label for="demo-search">Search</x-ui.label>
            <x-ui.input id="demo-search" name="demo_search" type="search" placeholder="Search…" />
          </x-ui.field>

          <x-ui.field>
            <x-ui.label for="demo-readonly">Readonly</x-ui.label>
            <x-ui.input id="demo-readonly" name="demo_readonly" value="Read-only value" readonly />
          </x-ui.field>

          <x-ui.field disabled>
            <x-ui.label for="demo-disabled" disabled>Disabled</x-ui.label>
            <x-ui.input id="demo-disabled" name="demo_disabled" value="Unavailable" disabled />
          </x-ui.field>

          <x-ui.field invalid>
            <x-ui.label for="demo-invalid" required>Invalid</x-ui.label>
            <x-ui.input id="demo-invalid" name="demo_invalid" invalid value="bad value" aria-describedby="demo-invalid-error" />
            <x-ui.field.error id="demo-invalid-error" message="This field has an error." />
          </x-ui.field>
        </div>

        <x-ui.field>
          <x-ui.label for="demo-file">File upload</x-ui.label>
          <x-ui.input id="demo-file" name="demo_file" type="file" />
          <x-ui.field.description>File input menggunakan utilitas <code class="text-xs font-mono">file:</code> Tailwind untuk styling yang konsisten.</x-ui.field.description>
        </x-ui.field>
      </x-ui.card.content>
    </x-ui.card>

    <pre class="overflow-x-auto rounded-lg border border-border bg-muted p-4 text-sm text-foreground"><code class="font-mono">@verbatim
&lt;x-ui.input
    id="email"
    name="email"
    type="email"
    placeholder="you@example.com"
    required
/&gt;

&lt;!-- Invalid state --&gt;
&lt;x-ui.input
    :invalid="$errors - & gt;
    has('email')"
    aria-describedby="email-error"
/&gt;
@endverbatim
</code>
</pre>
  </section>

  {{-- =====================================================================
         SECTION: TEXTAREA
         ===================================================================== --}}
  <section class="flex flex-col gap-4" aria-labelledby="textarea-heading">
    <x-ui.heading id="textarea-heading" variant="section">Textarea</x-ui.heading>

    <x-ui.card>
      <x-ui.card.content class="flex flex-col gap-5 pt-6">
        <div class="grid gap-4 sm:grid-cols-2">
          <x-ui.field>
            <x-ui.label for="demo-bio">Default</x-ui.label>
            <x-ui.textarea id="demo-bio" name="demo_bio" placeholder="Tell us about yourself…"></x-ui.textarea>
            <x-ui.field.description>Textarea native default 4 baris dan dapat di-resize vertikal.</x-ui.field.description>
          </x-ui.field>

          <x-ui.field invalid>
            <x-ui.label for="demo-bio-invalid" required>Invalid</x-ui.label>
            <x-ui.textarea id="demo-bio-invalid" name="demo_bio_invalid" invalid aria-describedby="bio-error">Too short</x-ui.textarea>
            <x-ui.field.error id="bio-error" message="Bio harus minimal 10 karakter." />
          </x-ui.field>

          <x-ui.field disabled>
            <x-ui.label for="demo-bio-disabled" disabled>Disabled</x-ui.label>
            <x-ui.textarea id="demo-bio-disabled" disabled>Unavailable content</x-ui.textarea>
          </x-ui.field>
        </div>
      </x-ui.card.content>
    </x-ui.card>
  </section>

  {{-- =====================================================================
         SECTION: SELECT
         ===================================================================== --}}
  <section class="flex flex-col gap-4" aria-labelledby="select-heading">
    <x-ui.heading id="select-heading" variant="section">Select</x-ui.heading>

    <x-ui.card>
      <x-ui.card.content class="flex flex-col gap-5 pt-6">
        <div class="grid gap-4 sm:grid-cols-2">
          <x-ui.field>
            <x-ui.label for="demo-role" required>Role</x-ui.label>
            <x-ui.select id="demo-role" name="demo_role" placeholder="Select a role" required>
              <option value="member">Member</option>
              <option value="editor">Editor</option>
              <option value="admin">Administrator</option>
            </x-ui.select>
          </x-ui.field>

          <x-ui.field invalid>
            <x-ui.label for="demo-region">Region</x-ui.label>
            <x-ui.select id="demo-region" name="demo_region" placeholder="Select a region" invalid aria-describedby="region-error">
              <option value="">No region</option>
            </x-ui.select>
            <x-ui.field.error id="region-error" message="Pilih region sebelum melanjutkan." />
          </x-ui.field>

          <x-ui.field disabled>
            <x-ui.label for="demo-plan" disabled>Disabled</x-ui.label>
            <x-ui.select id="demo-plan" name="demo_plan" disabled>
              <option value="free" selected>Free</option>
            </x-ui.select>
          </x-ui.field>
        </div>
      </x-ui.card.content>
    </x-ui.card>
  </section>

  {{-- =====================================================================
         SECTION: CHECKBOX
         ===================================================================== --}}
  <section class="flex flex-col gap-4" aria-labelledby="checkbox-heading">
    <x-ui.heading id="checkbox-heading" variant="section">Checkbox</x-ui.heading>

    <x-ui.card>
      <x-ui.card.content class="flex flex-col gap-5 pt-6">
        <x-ui.field orientation="horizontal">
          <x-ui.checkbox id="demo-terms" name="demo_terms" />
          <div class="flex flex-col gap-1">
            <x-ui.label for="demo-terms">Accept terms and conditions</x-ui.label>
            <x-ui.field.description>Checkbox native dengan label terasosiasi.</x-ui.field.description>
          </div>
        </x-ui.field>

        <x-ui.field orientation="horizontal">
          <x-ui.checkbox id="demo-checked" name="demo_checked" checked />
          <x-ui.label for="demo-checked">Checked by default</x-ui.label>
        </x-ui.field>

        <x-ui.field orientation="horizontal" disabled>
          <x-ui.checkbox id="demo-checkbox-disabled" disabled />
          <x-ui.label for="demo-checkbox-disabled" disabled>Disabled checkbox</x-ui.label>
        </x-ui.field>

        <x-ui.field orientation="horizontal" invalid>
          <x-ui.checkbox id="demo-checkbox-invalid" invalid aria-describedby="checkbox-error" />
          <div class="flex flex-col gap-1">
            <x-ui.label for="demo-checkbox-invalid">Required checkbox</x-ui.label>
            <x-ui.field.error id="checkbox-error" message="Anda harus menyetujui syarat ini." />
          </div>
        </x-ui.field>
      </x-ui.card.content>
    </x-ui.card>
  </section>

  {{-- =====================================================================
         SECTION: SWITCH
         ===================================================================== --}}
  <section class="flex flex-col gap-4" aria-labelledby="switch-heading">
    <x-ui.heading id="switch-heading" variant="section">Switch</x-ui.heading>

    <x-ui.card>
      <x-ui.card.content class="flex flex-col gap-5 pt-6">
        <x-ui.field orientation="horizontal" class="items-center justify-between">
          <div class="flex flex-col gap-1">
            <x-ui.label for="demo-notif">Enable notifications</x-ui.label>
            <x-ui.field.description>Switch menggunakan checkbox native dengan <code class="text-xs font-mono">role="switch"</code>.</x-ui.field.description>
          </div>
          <x-ui.switch id="demo-notif" name="demo_notif" checked />
        </x-ui.field>

        <x-ui.field orientation="horizontal" class="items-center justify-between">
          <x-ui.label for="demo-switch-off">Off by default</x-ui.label>
          <x-ui.switch id="demo-switch-off" name="demo_switch_off" />
        </x-ui.field>

        <x-ui.field orientation="horizontal" class="items-center justify-between" disabled>
          <div class="flex flex-col gap-1">
            <x-ui.label for="demo-switch-disabled" disabled>Disabled switch</x-ui.label>
            <x-ui.field.description>State disabled terlihat dan tetap tidak dapat diinteraksi.</x-ui.field.description>
          </div>
          <x-ui.switch id="demo-switch-disabled" name="demo_switch_disabled" disabled />
        </x-ui.field>
      </x-ui.card.content>
    </x-ui.card>
  </section>

  {{-- =====================================================================
         SECTION: RADIO GROUP
         ===================================================================== --}}
  <section class="flex flex-col gap-4" aria-labelledby="radio-heading">
    <x-ui.heading id="radio-heading" variant="section">Radio Group</x-ui.heading>

    <div class="grid gap-4 sm:grid-cols-2">
      <x-ui.card>
        <x-ui.card.content class="pt-6">
          <x-ui.radio-group label="Density" description="Pilih satu level density.">
            <x-ui.radio-group.option name="demo_density" value="comfortable" checked>Comfortable</x-ui.radio-group.option>
            <x-ui.radio-group.option name="demo_density" value="compact" description="Tampilkan lebih banyak dalam ruang yang sama.">Compact</x-ui.radio-group.option>
            <x-ui.radio-group.option name="demo_density" value="unavailable" disabled>Unavailable</x-ui.radio-group.option>
          </x-ui.radio-group>
        </x-ui.card.content>
      </x-ui.card>

      <pre class="overflow-x-auto rounded-lg border border-border bg-muted p-4 text-sm text-foreground"><code class="font-mono">@verbatim
&lt;x-ui.radio-group
    label="Density"
    description="Choose density."
&gt;
    &lt;x-ui.radio-group.option
        name="density"
        value="comfortable"
        checked
    &gt;Comfortable&lt;/x-ui.radio-group.option&gt;

    &lt;x-ui.radio-group.option
        name="density"
        value="compact"
        disabled
    &gt;Compact&lt;/x-ui.radio-group.option&gt;
&lt;/x-ui.radio-group&gt;
@endverbatim
</code>
</pre>
    </div>
  </section>

  {{-- =====================================================================
         SECTION: FIELD COMPOSITION
         ===================================================================== --}}
  <section class="flex flex-col gap-4" aria-labelledby="field-heading">
    <div class="flex flex-col gap-1">
      <x-ui.heading id="field-heading" variant="section">Field</x-ui.heading>
      <x-ui.heading variant="description">{{ __('x-ui.field mengintegrasikan label, control, description, dan error dalam satu unit yang accessible.') }}</x-ui.heading>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
      <x-ui.card>
        <x-ui.card.header>
          <x-ui.card.title>Valid field</x-ui.card.title>
          <x-ui.card.description>Label → Input → Description</x-ui.card.description>
        </x-ui.card.header>
        <x-ui.card.content>
          <x-ui.field>
            <x-ui.label for="demo-name" required>Name</x-ui.label>
            <x-ui.input id="demo-name" name="demo_name" autocomplete="name" placeholder="Your name" required />
            <x-ui.field.description>Nama ini ditampilkan pada profil pengguna.</x-ui.field.description>
          </x-ui.field>
        </x-ui.card.content>
      </x-ui.card>

      <x-ui.card>
        <x-ui.card.header>
          <x-ui.card.title>Invalid field</x-ui.card.title>
          <x-ui.card.description>Label → Input (invalid) → Error</x-ui.card.description>
        </x-ui.card.header>
        <x-ui.card.content>
          <x-ui.field invalid>
            <x-ui.label for="demo-email-field" required>Email</x-ui.label>
            <x-ui.input id="demo-email-field" name="demo_email_field" type="email" value="invalid-email" invalid aria-describedby="demo-email-field-error" />
            <x-ui.field.error id="demo-email-field-error" message="Masukkan alamat email yang valid." />
          </x-ui.field>
        </x-ui.card.content>
      </x-ui.card>

      <x-ui.card>
        <x-ui.card.header>
          <x-ui.card.title>Horizontal field</x-ui.card.title>
          <x-ui.card.description>orientation="horizontal" untuk layout inline.</x-ui.card.description>
        </x-ui.card.header>
        <x-ui.card.content>
          <x-ui.field orientation="horizontal" class="items-center justify-between">
            <div class="flex flex-col gap-1">
              <x-ui.label for="demo-inline-switch">Marketing emails</x-ui.label>
              <x-ui.field.description>Terima email promosi dari tim kami.</x-ui.field.description>
            </div>
            <x-ui.switch id="demo-inline-switch" name="demo_inline_switch" />
          </x-ui.field>
        </x-ui.card.content>
      </x-ui.card>

      <x-ui.card>
        <x-ui.card.header>
          <x-ui.card.title>Livewire &amp; Alpine API</x-ui.card.title>
        </x-ui.card.header>
        <x-ui.card.content>
          <pre class="overflow-x-auto rounded-lg border border-border bg-muted p-3 text-xs text-foreground"><code class="font-mono">@verbatim
&lt;x-ui.field :invalid="$errors->has('email')"&gt;
    &lt;x-ui.label for="email" required&gt;Email&lt;/x-ui.label&gt;
    &lt;x-ui.input
        id="email"
        type="email"
        wire:model.live="email"
        :invalid="$errors->has('email')"
        aria-describedby="email-error"
    /&gt;
    &lt;x-ui.field.error id="email-error" name="email" /&gt;
&lt;/x-ui.field&gt;

&lt;!-- Alpine local state --&gt;
&lt;x-ui.input x-model="search" x-on:input="filter()" /&gt;
@endverbatim
</code>
</pre>
        </x-ui.card.content>
      </x-ui.card>
    </div>
  </section>

  {{-- =====================================================================
         SECTION: INPUT GROUP
         ===================================================================== --}}
  <section class="flex flex-col gap-4" aria-labelledby="input-group-heading">
    <div class="flex flex-col gap-1">
      <x-ui.heading id="input-group-heading" variant="section">Input Group</x-ui.heading>
      <x-ui.heading variant="description">{{ __('Input Group mengomposisikan input, addon teks/ikon, dan button dalam satu unit visual yang terhubung tanpa JavaScript.') }}</x-ui.heading>
    </div>

    <x-ui.card>
      <x-ui.card.content class="flex flex-col gap-6 pt-6">
        {{-- A: URL prefix --}}
        <x-ui.field>
          <x-ui.label for="ig-url">Website</x-ui.label>
          <x-ui.input-group>
            <x-ui.input-group.addon>https://</x-ui.input-group.addon>
            <x-ui.input id="ig-url" name="ig_url" type="url" placeholder="example.com" />
          </x-ui.input-group>
        </x-ui.field>

        {{-- B: Currency --}}
        <x-ui.field>
          <x-ui.label for="ig-amount">Amount</x-ui.label>
          <x-ui.input-group>
            <x-ui.input-group.addon>$</x-ui.input-group.addon>
            <x-ui.input id="ig-amount" name="ig_amount" type="number" placeholder="0.00" step="0.01" min="0" />
            <x-ui.input-group.addon>USD</x-ui.input-group.addon>
          </x-ui.input-group>
        </x-ui.field>

        {{-- C: Search with button --}}
        <x-ui.field>
          <x-ui.label for="ig-search">Search</x-ui.label>
          <x-ui.input-group>
            <x-ui.input id="ig-search" name="ig_search" type="search" placeholder="Search documents…" />
            <x-ui.button type="button" variant="secondary">Search</x-ui.button>
          </x-ui.input-group>
        </x-ui.field>

        {{-- D: Icon addon --}}
        <x-ui.field>
          <x-ui.label for="ig-icon-search">Find</x-ui.label>
          <x-ui.input-group>
            <x-ui.input-group.addon aria-hidden="true">
              <x-ui.icon name="search" class="size-4" />
            </x-ui.input-group.addon>
            <x-ui.input id="ig-icon-search" name="ig_icon_search" type="search" placeholder="Find anything…" />
          </x-ui.input-group>
        </x-ui.field>

        {{-- E: Suffix domain --}}
        <x-ui.field>
          <x-ui.label for="ig-username">Username</x-ui.label>
          <x-ui.input-group>
            <x-ui.input id="ig-username" name="ig_username" placeholder="yourname" />
            <x-ui.input-group.addon>.example.com</x-ui.input-group.addon>
          </x-ui.input-group>
        </x-ui.field>
      </x-ui.card.content>
    </x-ui.card>

    <pre class="overflow-x-auto rounded-lg border border-border bg-muted p-4 text-sm text-foreground"><code class="font-mono">@verbatim
{{-- Prefix addon --}}
&lt;x-ui.input-group&gt;
    &lt;x-ui.input-group.addon&gt;https://&lt;/x-ui.input-group.addon&gt;
    &lt;x-ui.input type="url" placeholder="example.com" /&gt;
&lt;/x-ui.input-group&gt;

{{-- Icon addon --}}
&lt;x-ui.input-group&gt;
    &lt;x-ui.input-group.addon aria-hidden="true"&gt;
        &lt;x-ui.icon name="search" class="size-4" /&gt;
    &lt;/x-ui.input-group.addon&gt;
    &lt;x-ui.input type="search" placeholder="Search…" /&gt;
&lt;/x-ui.input-group&gt;

{{-- Input + Button --}}
&lt;x-ui.input-group&gt;
    &lt;x-ui.input type="search" placeholder="Search…" /&gt;
    &lt;x-ui.button type="button" variant="secondary"&gt;Search&lt;/x-ui.button&gt;
&lt;/x-ui.input-group&gt;
@endverbatim
</code>
</pre>
  </section>

  {{-- =====================================================================
         SECTION: BUTTON GROUP
         ===================================================================== --}}
  <section class="flex flex-col gap-4" aria-labelledby="button-group-heading">
    <div class="flex flex-col gap-1">
      <x-ui.heading id="button-group-heading" variant="section">Button Group</x-ui.heading>
      <x-ui.heading variant="description">{{ __('Button Group mengomposisikan beberapa button adjacent dalam satu unit visual, tanpa JavaScript.') }}</x-ui.heading>
    </div>

    <x-ui.card>
      <x-ui.card.content class="flex flex-col gap-6 pt-6">
        {{-- Horizontal --}}
        <div class="flex flex-col gap-3">
          <p class="text-sm font-medium text-foreground">Horizontal <span class="text-muted-foreground font-normal">(default)</span></p>
          <x-ui.button-group>
            <x-ui.button variant="outline">Left</x-ui.button>
            <x-ui.button variant="outline">Center</x-ui.button>
            <x-ui.button variant="outline">Right</x-ui.button>
          </x-ui.button-group>
        </div>

        {{-- Horizontal with default variant --}}
        <div class="flex flex-col gap-3">
          <p class="text-sm font-medium text-foreground">Horizontal — Filled</p>
          <x-ui.button-group>
            <x-ui.button>Day</x-ui.button>
            <x-ui.button>Week</x-ui.button>
            <x-ui.button>Month</x-ui.button>
            <x-ui.button disabled>Year</x-ui.button>
          </x-ui.button-group>
        </div>

        {{-- Vertical --}}
        <div class="flex flex-col gap-3">
          <p class="text-sm font-medium text-foreground">Vertical</p>
          <x-ui.button-group orientation="vertical" class="w-fit">
            <x-ui.button variant="outline">Top</x-ui.button>
            <x-ui.button variant="outline">Middle</x-ui.button>
            <x-ui.button variant="outline">Bottom</x-ui.button>
          </x-ui.button-group>
        </div>
      </x-ui.card.content>
    </x-ui.card>

    <pre class="overflow-x-auto rounded-lg border border-border bg-muted p-4 text-sm text-foreground"><code class="font-mono">@verbatim
{{-- Horizontal (default) --}}
&lt;x-ui.button-group&gt;
    &lt;x-ui.button variant="outline"&gt;Left&lt;/x-ui.button&gt;
    &lt;x-ui.button variant="outline"&gt;Center&lt;/x-ui.button&gt;
    &lt;x-ui.button variant="outline"&gt;Right&lt;/x-ui.button&gt;
&lt;/x-ui.button-group&gt;

{{-- Vertical --}}
&lt;x-ui.button-group orientation="vertical"&gt;
    &lt;x-ui.button&gt;Top&lt;/x-ui.button&gt;
    &lt;x-ui.button&gt;Bottom&lt;/x-ui.button&gt;
&lt;/x-ui.button-group&gt;
@endverbatim
</code></pre>
  </section>

  {{-- =====================================================================
         SECTION: FORM COMPOSITION
         ===================================================================== --}}
  <section class="flex flex-col gap-4" aria-labelledby="form-composition-heading">
    <div class="flex flex-col gap-1">
      <x-ui.heading id="form-composition-heading" variant="section">Form Composition</x-ui.heading>
      <x-ui.heading variant="description">{{ __('Contoh form realistis yang menggabungkan beberapa primitive. Data statis, tidak ada persistence.') }}</x-ui.heading>
    </div>

    <x-ui.card>
      <x-ui.card.header>
        <x-ui.card.title>Account Information</x-ui.card.title>
        <x-ui.card.description>Contoh komposisi Field Group + Input + Select + Switch + Input Group.</x-ui.card.description>
      </x-ui.card.header>
      <x-ui.card.content>
        <form class="flex flex-col gap-6" aria-label="{{ __('Account information form preview') }}" onsubmit="return false">
          <div class="grid gap-4 sm:grid-cols-2">
            <x-ui.field>
              <x-ui.label for="fc-name" required>Name</x-ui.label>
              <x-ui.input id="fc-name" name="fc_name" autocomplete="name" placeholder="Your name" required />
            </x-ui.field>

            <x-ui.field>
              <x-ui.label for="fc-email" required>Email</x-ui.label>
              <x-ui.input id="fc-email" name="fc_email" type="email" autocomplete="email" placeholder="you@example.com" required />
            </x-ui.field>

            <x-ui.field>
              <x-ui.label for="fc-role" required>Role</x-ui.label>
              <x-ui.select id="fc-role" name="fc_role" placeholder="Select a role" required>
                <option value="member">Member</option>
                <option value="admin">Administrator</option>
              </x-ui.select>
            </x-ui.field>

            <x-ui.field>
              <x-ui.label for="fc-website">Website</x-ui.label>
              <x-ui.input-group>
                <x-ui.input-group.addon>https://</x-ui.input-group.addon>
                <x-ui.input id="fc-website" name="fc_website" type="url" placeholder="example.com" />
              </x-ui.input-group>
            </x-ui.field>
          </div>

          <x-ui.field orientation="horizontal" class="items-center justify-between">
            <div class="flex flex-col gap-1">
              <x-ui.label for="fc-notifications">Email notifications</x-ui.label>
              <x-ui.field.description>Terima ringkasan mingguan via email.</x-ui.field.description>
            </div>
            <x-ui.switch id="fc-notifications" name="fc_notifications" />
          </x-ui.field>

          <div class="flex items-center justify-end gap-3">
            <x-ui.button type="button" variant="outline">Cancel</x-ui.button>
            <x-ui.button type="submit">Save changes</x-ui.button>
          </div>
        </form>
      </x-ui.card.content>
    </x-ui.card>
  </section>

  {{-- =====================================================================
         SECTION: ACCESSIBILITY & API NOTES
         ===================================================================== --}}
  <section class="flex flex-col gap-4" aria-labelledby="api-heading">
    <x-ui.heading id="api-heading" variant="section">API &amp; Accessibility Notes</x-ui.heading>
    <x-ui.alert>
      <x-ui.alert.title>Atribut diteruskan sepenuhnya</x-ui.alert.title>
      <x-ui.alert.description>Semua komponen input (Input, Textarea, Select, Checkbox, Switch, Radio) meneruskan <code class="text-xs font-mono">wire:*</code>, <code class="text-xs font-mono">x-*</code>, <code class="text-xs font-mono">aria-*</code>, dan atribut HTML native ke elemen root mereka.
        Input Group dan Button Group adalah wrapper pasif tanpa state JavaScript.</x-ui.alert.description>
    </x-ui.alert>
    <x-ui.alert>
      <x-ui.alert.title>Label association &amp; aria-describedby</x-ui.alert.title>
      <x-ui.alert.description>Gunakan <code class="text-xs font-mono">for</code> pada Label yang cocok dengan <code class="text-xs font-mono">id</code> control. Untuk error dan description, teruskan <code class="text-xs font-mono">aria-describedby</code> secara manual ke control, dan berikan
        <code class="text-xs font-mono">id</code> yang sama ke <code class="text-xs font-mono">x-ui.field.error</code> atau <code class="text-xs font-mono">x-ui.field.description</code>.</x-ui.alert.description>
    </x-ui.alert>
  </section>
</x-playground.layout>
