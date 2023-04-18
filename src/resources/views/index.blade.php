
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Демо Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <h1>Темы</h1>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Статус</th>
            <th scope="col">Действия</th>
          </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)

            <tr>
                <th scope="row"></th>
                <td> {{$post->title}}</td>
                <td> {{$post->active}}</td>
                <td>
                    
                    <form method="POST" action="{{route('setThemes', $post->id)}}">
                        
                        <div class="mb-3">
                          <input type="hidden" class="form-control" name="id" value="{{$post->id}}">
                        </div>

                        <button type="submit" class="btn btn-primary">Активировать</button>
                      </form>


                </td>
              </tr>


           
            @endforeach


        </tbody>
      </table>

   



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>