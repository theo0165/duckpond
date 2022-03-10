<x-layout>
    <div class="container col-6">
        <h1 class="mb-3">Submit</h1>
        <form method="POST" action="/submit">
            @csrf
            <div class="mb-4">
                <label for="type" class="form-label">Type</label>
                <div>
                    <div class="form-check">
                        <input type="radio" name="type" value="text" id="text" checked class="form-check-input">
                        <label for="text" class="form-check-label">Text</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="type" value="link" id="link" class="form-check-input">
                        <label for="link" class="form-check-label">Link</label>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="mb-4">
                <label for="content" class="form-label">Content (text/link)</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="mb-4">
                <label for="community" class="form-label">Community</label>
                <select class="form-select" name="community" id="community">
                    <option disabled>Community</option>
                    @foreach ($communities as $community)
                        <option value="{{$community->title}}">/c/{{$community->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-5">
                <button type="submit" class="form-control btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</x-layout>
