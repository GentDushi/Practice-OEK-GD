<x-primary-layout>
    <h2>Register</h2>
    {{-- Registration form --}}
    <form method="POST" action="/register">
        @csrf
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <label for="password_confirmation">Confirm password:</label><br>
        <input type="password" id="password_confirmation" name="password_confirmation">
        <br>
        <input type="submit" value="Register" />
        {{-- Show errors in a list --}}
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        {{-- Show informative messages --}}
        @if (session()->has('message'))
            {{ session()->get('message') }}
        @endif
    </form>
    <br>
    {{-- Go to login page --}}
    <a href="/">Login</a>
</x-primary-layout>
