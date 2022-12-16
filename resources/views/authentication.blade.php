<x-primary-layout>
    <h2>Login</h2>
    {{-- Login form --}}
    <form method="POST" action="/authenticate">
        @csrf
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login" />
        {{-- Show errors --}}
        @error('error_field')
            {{ $message }}
        @enderror
    </form>
    <br>
    {{-- Go to registration form --}}
    <a href="/registration">Register</a>   
</x-primary-layout>
