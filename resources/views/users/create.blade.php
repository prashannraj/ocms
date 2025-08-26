<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New User') }}
        </h2>
    </x-slot>

    <div class="mt-6 max-w-3xl mx-auto bg-white dark:bg-gray-800 p-6 shadow-md rounded">
        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required
                       class="w-full px-3 py-2 border rounded shadow-sm dark:bg-gray-700 dark:text-white">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                       class="w-full px-3 py-2 border rounded shadow-sm dark:bg-gray-700 dark:text-white">
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Password</label>
                <input id="password" name="password" type="password" required
                       class="w-full px-3 py-2 border rounded shadow-sm dark:bg-gray-700 dark:text-white">
            </div>

            <!-- Role Selection -->
            <div class="mb-4">
                <label for="role" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Role</label>
                <select id="role" name="role" required
                        class="w-full px-3 py-2 border rounded shadow-sm dark:bg-gray-700 dark:text-white">
                    <option value="">-- Select Role --</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit -->
            <div class="flex justify-end">
                <a href="{{ route('users.index') }}"
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Cancel
                </a>
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Create User
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
