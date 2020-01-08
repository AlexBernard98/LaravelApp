<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Chris's Computer Shop Edit Question Page</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <div class="container">
      <h2>Edit A Product</h2><br  />
      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div><br />
      @endif
      <form method="post" action="{{action('QuestionController@update', $id)}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="topic">Topic:</label>
            <input type="text" class="form-control" name="topic" value="{{$question->topic}}">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="description">Description:</label>
              <input type="text" class="form-control" name="description" value="{{$question->description}}">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <button type="submit" class="btn btn-success" style="margin-left:38px">Update Question</button>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>

