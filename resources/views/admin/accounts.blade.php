@extends('layouts.apps')

@section('content')

  <div x-data="{
        tab: 'user',
        showDeleteModal: false,
        deleteUrl: ''
    }" class="mt-6 mb-6">

    <!-- Tabs -->
    <div class="flex gap-4 mb-4 border-b dark:border-gray-700 pb-2">

      @foreach(['user', 'personnel', 'admin'] as $role)
        <button @click="tab = '{{ $role }}'" :class="tab === '{{ $role }}'
                  ? 'text-blue-600 border-b-2 border-blue-600'
                  : 'text-gray-500'" class="px-3 py-1 font-semibold capitalize">

          {{ $role }}
        </button>
      @endforeach

    </div>

    <!-- TABLE -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
      <div class="w-full overflow-x-auto">

        <table class="w-full whitespace-no-wrap">
          <thead>
            <tr
              class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
              <th class="px-4 py-3">Users</th>
              <th class="px-4 py-3">Role</th>
              <th class="px-4 py-3">Action</th>
              <th class="px-4 py-3">Date</th>
            </tr>
          </thead>

          <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

            @foreach($users as $user)

              <tr x-show="tab === '{{ strtolower($user->role->name ?? 'user') }}'" class="text-gray-700 dark:text-white">

                <!-- User Info -->
                <td class="px-4 py-3">
                  <p class="font-semibold">
                    {{ $user->fname }} {{ $user->lname }}
                  </p>
                  <p class="text-xs text-gray-600 dark:text-gray-400">
                    {{ $user->email }}
                  </p>
                </td>

                <!-- Role -->
                <td class="px-4 py-3 text-sm capitalize">
                  {{ $user->role->name ?? 'user' }}
                </td>

                <!-- Actions -->
                <td class="px-4 py-3 text-xs flex gap-2">

                  <!-- Update -->
                  <a href="{{ route('edit-account.admin', $user->id) }}"
                    class="px-2 py-1 font-semibold text-green-700 bg-green-100 rounded-full">
                    Update
                  </a>

                  @if(in_array($user->role->name ?? '', ['user', 'personnel'], true))
                    <button type="button" @click="showDeleteModal = true; deleteUrl = '{{ route('accounts.destroy', $user->id) }}';"
                      class="px-2 py-1 font-semibold text-amber-800 bg-amber-100 rounded-full">
                      Archive
                    </button>
                  @endif

                </td>

                <!-- Date -->
                <td class="px-4 py-3 text-sm">
                  {{ $user->updated_at->format('m/d/Y') }}
                </td>

              </tr>

            @endforeach

          </tbody>
        </table>
        @if(session('success') || session('error'))
          <div x-data="{ open: true }" x-show="open" x-transition
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display:none;">

            <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-xl dark:bg-gray-800">

              <h2 class="text-lg font-bold
                {{ session('success') ? 'text-green-600' : 'text-red-600' }}">

                {{ session('success') ? 'Success' : 'Notice' }}
              </h2>

              <p class="mt-3 text-sm text-gray-600 dark:text-gray-300">
                {{ session('success') ?? session('error') }}
              </p>

              <div class="flex justify-end mt-6">
                <button @click="open = false" class="px-4 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-700">
                  OK
                </button>
              </div>

            </div>

          </div>
        @endif
        <!-- Delete Modal -->
        <div x-show="showDeleteModal" x-transition
          class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display:none;">

          <div @click.away="showDeleteModal = false"
            class="w-full max-w-md p-6 bg-white rounded-lg shadow-xl dark:bg-gray-800">

            <h2 class="text-lg font-bold text-gray-800 dark:text-white">
              Archive Account
            </h2>

            <p class="mt-3 text-sm text-gray-600 dark:text-gray-300">
              Are you sure you want to archive this account? The account will be unable to sign in and can be restored later.
            </p>

            <div class="flex justify-end gap-3 mt-6">

              <button @click="showDeleteModal = false"
                class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                Cancel
              </button>

              <form :action="deleteUrl" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700">
                  Archive Account
                </button>
              </form>

            </div>

          </div>
        </div>
      </div>
    </div>

  </div>

@endsection