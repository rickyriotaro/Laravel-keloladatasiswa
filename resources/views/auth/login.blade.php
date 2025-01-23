<x-guest-layout>
    <div class="min-h-screen  flex items-center justify-center">
        <div class="bg-white p-10 rounded-lg  w-full max-w-lg">
            <!-- Logo and Welcome Text -->
            <div class="flex flex-wrap gap-5 items-center mb-10">

                <div class="flex flex-col ">
                    <h2 class="text-xl text-gray-800 font-semibold text-center">Welcome To Raport System</h2>
                    <p class="text-sm text-gray-500 text-center">Sign in to continue to your dashboard</p>
                </div>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email Input -->
                <div class="relative mb-6">
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="block w-full text-sm h-[50px] px-4 text-slate-900 bg-white rounded-lg border border-violet-200 appearance-none focus:outline-none focus:ring-2 focus:ring-violet-500"
                        placeholder="Email Address"
                        value="{{ old('email') }}"
                        required
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password Input -->
                <div class="relative mb-6">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="block w-full text-sm h-[50px] px-4 text-slate-900 bg-white rounded-lg border border-violet-200 appearance-none focus:outline-none focus:ring-2 focus:ring-violet-500"
                        placeholder="Password"
                        required
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button
                        class="w-full sm:w-auto px-5 py-2 bg-violet-500 hover:bg-violet-600 text-white rounded-lg transition-all duration-300"
                        type="submit"
                    >
                        Log In
                    </button>
                </div>
            </form>

            <!-- Forgot Password -->
        </div>
    </div>
</x-guest-layout>
