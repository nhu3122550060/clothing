<x-base>
    <x-slot name="title">{{ $profileData['name'] }} - Simple Profile</x-slot>
    
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Simple Profile Test</h1>
        
        <div class="space-y-4">
            <p><strong>Name:</strong> {{ $profileData['name'] }}</p>
            <p><strong>Title:</strong> {{ $profileData['title'] }}</p>
            <p><strong>Email:</strong> {{ $profileData['email'] }}</p>
        </div>
        
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4">Debug Data:</h2>
            <pre class="bg-gray-100 p-4 rounded text-sm overflow-x-auto">
{{ var_export($profileData, true) }}
            </pre>
        </div>
    </div>
</x-base>
