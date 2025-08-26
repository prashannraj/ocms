<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    @if(session('status'))<div class="text-green-600 mb-3">{{ session('status') }}</div>@endif
    <a href="{{ route('users.create') }}" class="mb-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create New User</a>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white dark:bg-gray-800">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Name</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Email</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Role</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800">
                @foreach($users as $user)
                <tr>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">{{ $user->name }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">{{ $user->email }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">{{ $user->roles->pluck('name')->join(', ') }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-right">
                        <a href="{{ route('users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                        @if(!$user->hasRole('super_admin'))
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $users->links() }}
    </div>

   </x-app-layout>
