<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8 space-y-6">

        {{-- Stat Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-5">
                <div class="text-gray-600 dark:text-gray-300 text-sm">Total Users</div>
                <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalUsers }}</div>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-5">
                <div class="text-gray-600 dark:text-gray-300 text-sm">Total Roles</div>
                <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalRoles }}</div>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-5">
                <div class="text-gray-600 dark:text-gray-300 text-sm">Online Users</div>
                <div class="text-2xl font-bold text-gray-900 dark:text-white">--</div> {{-- Optional --}}
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-5">
                <div class="text-gray-600 dark:text-gray-300 text-sm">New Signups</div>
                <div class="text-2xl font-bold text-gray-900 dark:text-white">--</div> {{-- Optional --}}
            </div>
        </div>

        {{-- Recent Users --}}
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-5">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Recent Users</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Name</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Email</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Role</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($latestUsers as $user)
                            <tr>
                                <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">{{ $user->name }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">{{ $user->email }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">{{ $user->roles->pluck('name')->join(', ') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-2 text-sm text-gray-500 dark:text-gray-400">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Optional Chart Placeholder --}}
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-5">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">User Activity</h3>
            <div id="chart-container" class="h-64 bg-gray-100 dark:bg-gray-700 rounded"></div>
        </div>

    </div>
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Example Chart.js initialization (replace with actual data and configuration)
    const ctx = document.getElementById('chart-container').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
                label: 'User Signups',
                data: [10, 20, 15, 30, 25, 40],
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>