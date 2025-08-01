<x-base>
    <x-slot name="title">{{ $profile['name'] }} - Debug Profile</x-slot>
    
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Profile Debug Page</h1>
        <p>Name: {{ $profile['name'] }}</p>
        <p>Title: {{ $profile['title'] }}</p>
        
        <div class="mt-4">
            <h2 class="text-xl font-semibold">Debug Info:</h2>
            <pre class="bg-gray-100 p-4 rounded">
                Profile data: {{ json_encode($profile, JSON_PRETTY_PRINT) }}
            </pre>
        </div>
    </div>
</x-base>
