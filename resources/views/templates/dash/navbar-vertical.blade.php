<x-nav-container>
    @slot('content')
        <x-nav-menu-item title="Dashboard" icon="home">
            <x-nav-menu-item title="Monitoring" href="{{ route('admin.dashboard') }}" icon="activity" />
            <x-nav-menu-item title="Task" href="{{ route('admin.task') }}" icon="check-square" />
        </x-nav-menu-item>

        <x-nav-menu-item title="Administrasi" icon="shield">
            <x-nav-menu-item title="Master Data" icon="database" parent="Administrasi">
                <x-nav-menu-item title="Purchasing Group"
                    href="{{ route('admin.administrator.master_data.purchasing_group.index') }}" icon="shopping-cart" />
                <x-nav-menu-item title="Currency" href="{{ route('admin.administrator.master_data.currency.index') }}"
                    icon="dollar-sign" />
                <x-nav-menu-item title="Delivery Points"
                    href="{{ route('admin.administrator.master_data.delivery_points.index') }}" icon="map-pin" />
                <x-nav-menu-item title="UOMs" href="{{ route('admin.administrator.master_data.uoms.index') }}"
                    icon="sliders" />
                <x-nav-menu-item title="Incoterms" href="{{ route('admin.administrator.master_data.incoterm.index') }}"
                    icon="globe" />
                <x-nav-menu-item title="Tax Code" href="{{ route('admin.administrator.master_data.tax_code.index') }}"
                    icon="percent" />
                <x-nav-menu-item title="Risk Assesment Subjects"
                    href="{{ route('admin.administrator.master_data.risk_assesment_subjects.index') }}"
                    icon="alert-circle" />
                <x-nav-menu-item title="Rancangan Kerja dan Syarat (RKS)"
                    href="{{ route('admin.administrator.master_data.rks.index') }}" icon="clipboard" />
                <x-nav-menu-item title="News" href="{{ route('admin.administrator.news.index') }}" icon="file-text" />
                <x-nav-menu-item title="Department"
                    href="{{ route('admin.administrator.master_data.department_division.index') }}" icon="briefcase" />
                <x-nav-menu-item title="Purchase Request Type"
                    href="{{ route('admin.administrator.master_data.purchase_request_type.index') }}" icon="file-plus" />
                <x-nav-menu-item title="Purchase Order Type"
                    href="{{ route('admin.administrator.master_data.purchase_order_type.index') }}" icon="shopping-bag" />
                <x-nav-menu-item title="Administration Text"
                    href="{{ route('admin.administrator.administration_texts.index') }}" icon="file" />
                <x-nav-menu-item title="Default Documents"
                    href="{{ route('admin.administrator.master_data.default_documents.index') }}" icon="folder" />
            </x-nav-menu-item>

            <x-nav-menu-item title="User Management" icon="users" parent="Administrasi">
                <x-nav-menu-item title="User" href="{{ route('admin.administrator.users.index') }}" icon="user" />
                <x-nav-menu-item title="Role" href="{{ route('admin.administrator.user_management.roles.index') }}"
                    icon="unlock" />
                <x-nav-menu-item title="Guest" href="{{ route('admin.guest.index') }}" icon="user-plus" />
                <x-nav-menu-item title="Karyawan" href="{{ route('admin.administrator.user_management.employees.index') }}"
                    icon="briefcase" />
            </x-nav-menu-item>

            <x-nav-menu-item title="Vendor Management" icon="bar-chart" parent="Administrasi">
                <x-nav-menu-item title="Vendor List" href="{{ route('admin.vendor.index') }}" icon="list" />
                <x-nav-menu-item title="VPI" href="{{ route('admin.vendor_performance.index') }}" icon="bar-chart-2" />
                <x-nav-menu-item title="VSI" href="#" icon="file" />
            </x-nav-menu-item>
        </x-nav-menu-item>
        <x-nav-menu-item title="PR Management" icon="layers">
            <x-nav-menu-item title="PR Non Proyek" href="{{ route('admin.purchase_request_header.index') }}"
                icon="file-text" />
            <x-nav-menu-item title="PR Proyek" href="{{ route('admin.purchase_request.index') }}" icon="list" />
        </x-nav-menu-item>

        <x-nav-menu-item title="Procurement Planning" icon="calendar">
            <x-nav-menu-item title="Pola Belanja" href="{{ route('admin.pola_belanja.index') }}" icon="list" />
            <x-nav-menu-item title="Paket Pekerjaan" href="{{ route('admin.purchase_plan.index') }}" icon="layers" />
        </x-nav-menu-item>

        <x-nav-menu-item title="Tender" icon="box">
            <x-nav-menu-item title="Tender List" href="{{ route('admin.tender.index') }}" icon="list" />
            <x-nav-menu-item title="Reverse Auction" href="{{ route('admin.reverse_auction.index') }}"
                icon="file-text" />
        </x-nav-menu-item>
        <x-nav-menu-item title="Purchase Order" href="{{ route('admin.purchase_order.index') }}" icon="file-plus" />
        <x-nav-menu-item title="Setting" icon="settings">
            <x-nav-menu-item title="App Setting" href="{{ route('admin.settings.index') }}" icon="bell" />
            <x-nav-menu-item title="Task Schedule" href="{{ route('admin.settings.task_schedules.index') }}"
                icon="bell" />
            <x-nav-menu-item title="SSO" href="{{ route('admin.settings.sso.index') }}" icon="bell" />
            <x-nav-menu-item title="Approval Blueprint" href="{{ route('admin.settings.approval_blueprints.index') }}"
                icon="bell" />
        </x-nav-menu-item>
    @endslot
</x-nav-container>
