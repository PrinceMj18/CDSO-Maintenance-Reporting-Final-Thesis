@extends('layouts.apps')

@section('content')

<div
    class="min-h-screen bg-gray-50 dark:bg-gray-900 p-6"
    x-data="{
        showConfirm: false,
        actionType: '',
        restoreForm: null,
        fileName: '',

        openConfirmation(type, form = null) {
            this.actionType = type;
            this.restoreForm = form;
            this.showConfirm = true;
        },

        confirmAction() {
            if (this.actionType === 'backup') {
                this.$refs.backupForm.submit();
            } else if (this.actionType === 'restore' && this.restoreForm) {
                this.restoreForm.submit();
            }

            this.showConfirm = false;
        }
    }"
>

    <div class="max-w-5xl mx-auto">

        <!-- PAGE HEADER -->
        <div class="mb-8">

            <p class="text-xs tracking-[0.3em] uppercase text-purple-600 dark:text-purple-400 font-semibold">
                System Administration
            </p>

            <h1 class="mt-2 text-3xl font-bold text-gray-800 dark:text-gray-100">
                Backup & Restore
            </h1>

            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Protect the maintenance reporting system by creating backups
                and restoring previously saved system data.
            </p>

        </div>


        <!-- SUCCESS MESSAGE -->
        @if(session('success'))

            <div class="mb-6 p-4 rounded-lg bg-green-100 border border-green-200 text-green-700 dark:bg-green-900/30 dark:border-green-800 dark:text-green-300">
                {{ session('success') }}
            </div>

        @endif


        <!-- ERROR MESSAGE -->
        @if(session('error'))

            <div class="mb-6 p-4 rounded-lg bg-red-100 border border-red-200 text-red-700 dark:bg-red-900/30 dark:border-red-800 dark:text-red-300">
                {{ session('error') }}
            </div>

        @endif


        <!-- VALIDATION ERRORS -->
        @if($errors->any())

            <div class="mb-6 p-4 rounded-lg bg-red-100 border border-red-200 text-red-700 dark:bg-red-900/30 dark:border-red-800 dark:text-red-300">

                <ul class="list-disc ml-5 text-sm">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">


            <!-- CREATE BACKUP -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">

                <div class="flex items-center mb-5">

                    <div class="p-3 rounded-lg bg-purple-100 dark:bg-purple-900/30">

                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414A1 1 0 0118 8.414V19a2 2 0 01-2 2z">
                            </path>

                        </svg>

                    </div>

                    <div class="ml-4">

                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                            Create Backup
                        </h2>

                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Download a complete system backup
                        </p>

                    </div>

                </div>


                <p class="text-sm text-gray-600 dark:text-gray-400 mb-5">

                    The backup contains the MySQL database and uploaded
                    maintenance images.

                </p>


                <div class="mb-5 space-y-2 text-sm text-gray-600 dark:text-gray-400">

                    <div class="flex items-center">
                        <span class="mr-2 text-green-500">✓</span>
                        Database records
                    </div>

                    <div class="flex items-center">
                        <span class="mr-2 text-green-500">✓</span>
                        User accounts and roles
                    </div>

                    <div class="flex items-center">
                        <span class="mr-2 text-green-500">✓</span>
                        Maintenance requests and logs
                    </div>

                    <div class="flex items-center">
                        <span class="mr-2 text-green-500">✓</span>
                        Inventory records
                    </div>

                    <div class="flex items-center">
                        <span class="mr-2 text-green-500">✓</span>
                        Uploaded maintenance images
                    </div>

                </div>


                <form
    x-ref="backupForm"
    action="{{ route('admin.backup.create') }}"
    method="POST"
>
    @csrf

    <button
        type="button"
        @click="openConfirmation('backup')"
        class="w-full px-5 py-3 text-sm font-semibold text-white bg-purple-600 rounded-lg hover:bg-purple-700 transition"
    >
        <span class="inline-flex items-center justify-center">
            <svg class="w-5 h-5 mr-2"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414A1 1 0 0118 8.414V19a2 2 0 01-2 2z">
                </path>
            </svg>

            Download Backup
        </span>
    </button>
</form>

            </div>



            <!-- RESTORE BACKUP -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">

                <div class="flex items-center mb-5">

                    <div class="p-3 rounded-lg bg-orange-100 dark:bg-orange-900/30">

                        <svg class="w-6 h-6 text-orange-600 dark:text-orange-400"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>

                        </svg>

                    </div>

                    <div class="ml-4">

                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                            Restore Backup
                        </h2>

                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Restore a previously created backup
                        </p>

                    </div>

                </div>


                <div class="p-4 mb-5 rounded-lg bg-yellow-50 border border-yellow-200 dark:bg-yellow-900/20 dark:border-yellow-800">

                    <p class="text-sm text-yellow-700 dark:text-yellow-300">

                        <strong>Warning:</strong>
                        Restoring a backup will replace existing database
                        records with the records contained in the backup.

                    </p>

                </div>


                <form
    x-ref="restoreForm"
    action="{{ route('admin.backup.restore') }}"
    method="POST"
    enctype="multipart/form-data"
    @submit.prevent="openConfirmation('restore', $event.target)"
>
    @csrf


                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Select Backup File
                    </label>


                    <input
    type="file"
    name="backup"
    accept=".zip"
    required
    @change="fileName = $event.target.files[0]?.name || ''"
    class="block w-full text-sm text-gray-600 dark:text-gray-300
           file:mr-4 file:py-2 file:px-4
           file:rounded-lg file:border-0
           file:text-sm file:font-semibold
           file:bg-purple-100 file:text-purple-700
           hover:file:bg-purple-200
           dark:file:bg-purple-900/30
           dark:file:text-purple-300"
>

<p
    x-show="fileName"
    x-text="fileName"
    class="mt-2 text-xs text-gray-500 dark:text-gray-400"
></p>


                    <button
    type="button"
    @click="if ($refs.restoreForm.reportValidity()) openConfirmation('restore', $refs.restoreForm)"
    class="w-full mt-5 px-5 py-3 text-sm font-semibold text-white bg-orange-600 rounded-lg hover:bg-orange-700 transition"
>
    Restore Backup
</button>

                </form>

            </div>

        </div>


        <!-- INFORMATION -->
        <div class="mt-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">

            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3">
                Backup Information
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 text-sm">

                <div>
                    <p class="font-semibold text-gray-700 dark:text-gray-300">
                        Backup Format
                    </p>

                    <p class="mt-1 text-gray-500 dark:text-gray-400">
                        ZIP archive
                    </p>
                </div>

                <div>
                    <p class="font-semibold text-gray-700 dark:text-gray-300">
                        Database
                    </p>

                    <p class="mt-1 text-gray-500 dark:text-gray-400">
                        MySQL
                    </p>
                </div>

                <div>
                    <p class="font-semibold text-gray-700 dark:text-gray-300">
                        Included Files
                    </p>

                    <p class="mt-1 text-gray-500 dark:text-gray-400">
                        Database
                    </p>
                </div>

            </div>

        </div>

    </div>
<!-- CONFIRMATION MODAL -->
<div
    x-cloak
    x-show="showConfirm"
    x-transition.opacity
    @keydown.escape.window="showConfirm = false"
    @click.self="showConfirm = false"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
    role="dialog"
    aria-modal="true"
    aria-labelledby="confirm-title"
>
    <div
        x-show="showConfirm"
        x-transition
        class="w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl dark:bg-gray-800"
    >
        <div
            class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full"
            :class="actionType === 'restore'
                ? 'bg-orange-100 text-orange-600 dark:bg-orange-900/30 dark:text-orange-400'
                : 'bg-purple-100 text-purple-600 dark:bg-purple-900/30 dark:text-purple-400'"
        >
            <svg class="h-7 w-7"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    :d="actionType === 'restore'
                        ? 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15'
                        : 'M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414A1 1 0 0118 8.414V19a2 2 0 01-2 2z'"
                />
            </svg>
        </div>

        <h2
            id="confirm-title"
            class="text-center text-xl font-bold text-gray-900 dark:text-white"
            x-text="actionType === 'restore'
                ? 'Restore System Backup?'
                : 'Create System Backup?'"
        ></h2>

        <p
            class="mt-3 text-center text-sm leading-6 text-gray-600 dark:text-gray-300"
            x-text="actionType === 'restore'
                ? 'Are you sure you want to restore this backup? Existing database records may be replaced. Make sure you have a recent backup before continuing.'
                : 'Do you want to create and download a backup of the maintenance system? This may take a moment.'"
        ></p>

        <div class="mt-6 flex gap-3">
            <button
                type="button"
                @click="showConfirm = false"
                class="flex-1 rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-700"
            >
                Cancel
            </button>

            <button
                type="button"
                @click="confirmAction()"
                class="flex-1 rounded-lg px-4 py-2.5 text-sm font-semibold text-white transition"
                :class="actionType === 'restore'
                    ? 'bg-orange-600 hover:bg-orange-700'
                    : 'bg-purple-600 hover:bg-purple-700'"
                x-text="actionType === 'restore'
                    ? 'Yes, Restore'
                    : 'Yes, Create Backup'"
            ></button>
        </div>
    </div>
</div>
</div>

@endsection