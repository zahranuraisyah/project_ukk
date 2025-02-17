<x-guest-layout>
    <h2 class="text-2xl font-semibold text-center mb-4 text-gray-800 mb-10">Login</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-4">Email</label>
            <input type="email" id="email" name="email" required 
                class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-200 mb-4">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-4">Password</label>
            <input type="password" id="password" name="password" required 
                class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-200">
        </div>

        <div class="flex justify-between items-center mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="remember" class="text-blue-600">
                <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>
            <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:underline">
                Forgot password?
            </a>
        </div>

        <button type="submit" 
            class="w-full bg-purple-400 text-white py-2 rounded-md hover:bg-purple-600 transition">
            Login
        </button>
    </form>
</x-guest-layout>
