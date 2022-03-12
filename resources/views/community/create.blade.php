<x-layout title="Create a community">
    <h1>Create a community</h1>
    <form action="{{ route('community.store') }}" method="post">
    @csrf
        <div>
            <x-form.input name="title" required />
        </div>
        <div>
            <x-form.button>Create</x-form.button>
        </div>
    </form>
</x-layout>
