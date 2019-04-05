@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
        @endif
        <div class="row" style="text-align: center">
            <div class="input col-8">
            <form method="post" action="{{url('/create/url')}}">
                <div class="form-group">
                    <input type="hidden" value="{{csrf_token()}}" name="_token" />
                    <label for="url">Paste your original URL here:</label>
                    <input type="text" style="width: 600px; margin-left: 50px" placeholder="http://yousite.com/" class="form-control" name="url"/>
                </div>
                <br>
                <!-- radio buttons -->
                <label for="status" id="" class="">Disable short url?</label><br>
                <input checked="checked" name="status" type="radio" value="never" id="status"> Never
                <input name="status" type="radio" value="60"> One minute
                <input name="status" type="radio" value="120"> Two minute
                <br>
                <button type="submit" class="btn btn-primary">Shorten URL</button>
            </form>
            </div>
            <div class="count col-4">
                <h3>Site statistics:</h3>
                <div class="row">
                <div class="all col-6">
                    <br>
                    <br>
                    <h5>{{$count}}</h5>
                    <h4>Total short urls</h4>
                </div>
                    <div class="short_all col-6">
                        <br>
                        <br>
                        <h5>{{$t_visited}}</h5>
                        <h4>Total url visits</h4>
                    </div>
                </div>
            </div>
        </div>
            </div>
    <br><br><br>
    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <td><b>Original Url</b></td>
                <td><b>Created_at</b></td>
                <td><b>Clicks</b></td>
                <td><b>Short Url</b></td>
            </tr>
            </thead>
            <tbody>



            @foreach($urls as $url)

                <tr>
                    <td><a style="color: #337ff1;" href="{{url('/create/url/' . $url->url)}}" target="_blank">{{$url->url}}</a> </td>
                    <td>{{$url->created_at}}</td>
                    <td>{{ $url->visited }}</td>
                    <td><a href="{{ url('/create/url/' . $url->short) }}" target="_blank">{{'https://fzn.go/' . $url->short }}</a>
                    </td>
                    {!! csrf_field() !!}
                </tr>
            @endforeach
            </tbody>
        </table>
{{ $urls->links() }}
        </div>
@endsection
