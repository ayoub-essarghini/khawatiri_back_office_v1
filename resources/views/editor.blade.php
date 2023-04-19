


<h1>Editor</h1>

<form action="{{route('editor.logout')}}" method="POST">
    @csrf
    <button type="submit" class="btn btn-primary">Log out</button>
    </form>