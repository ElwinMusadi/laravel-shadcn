<x-app.shell
    :title="$title ?? null"
    :description="$description ?? null"
    :breadcrumbs="$breadcrumbs ?? []"
    :show-page-header="$showPageHeader ?? false"
>
    {{ $slot }}
</x-app.shell>
