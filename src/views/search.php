<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>MovieSearch</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
</head>
<body>
<div class="row">
  <div class="col-md-12">
    <div class="well">
      <form class="form-horizontal">
        <div class="form-group">
          <label for="titleInput" class="col-sm-2 control-label">Réalisateur</label>
          <div class="col-sm-10">
            <input name="name" type="text" class="form-control" id="nameInput" placeholder="Nom du réalisateur">
          </div>
        </div>
        <div class="form-group">
          <label for="titleInput" class="col-sm-2 control-label">Titre</label>
          <div class="col-sm-10">
            <input name="title" type="text" class="form-control" id="titleInput" placeholder="Titre du film">
          </div>
        </div>
        <div class="form-group">
          <label for="durationInput" class="col-sm-2 control-label">Durée</label>
          <div class="col-sm-10">
            <select name="duration" class="form-control" id="durationInput">
              <option>Tous</option>
              <option>Moins d'une heure</option>
              <option>Entre 1h et 1h30</option>
              <option>Entre 1h30 et 2h30</option>
              <option>Plus de 2h30</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Année</label>
          <div class="col-sm-1">
            Entre
          </div>
          <div class="col-sm-4">
            <input name="year_start" type="text" class="form-control" id="yearStartInput" placeholder="début">
          </div>
          <div class="col-sm-1">
            Et
          </div>
          <div class="col-sm-4">
            <input name="year_end" type="text" class="form-control" id="yearEndInput" placeholder="fin">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Chercher</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="results">
  <table class="table table-hover">
    <tr>
      <th>
        Titre
      </th>
      <th>
        Année
      </th>
      <th>
        Synopsis
      </th>
      <th>
        Prénom/Nom
      </th>
      <th>
        Durée
      </th>
    </tr>
    <tr>
      <td id="">

      </td>
      <td id="movie-title">

      </td>
      <td id="movie-year">

      </td>
      <td id="movie-synopsis">

      </td>
      <td id="movie-duration">

      </td>
    </tr>
    
  </table>
</div>

<script>

  $(function(){


    $('form').submit(function(e){

      $.post("/Index/search",$(this).serialize(),function(data){
        if(typeof(data.error) != "undefined"){
          alert(data.error);
        }else{

          for (var i in data.films) {
            second = data.films[i].duration;
            minutes = second / 60;
            second = second % 60;
            hour = minutes / 60;
            minutes = minutes % 60;
            $('.table').append(
                '<tr><td>' + data.films[i].title + '</td><br>'
                + '<td>' + data.films[i].year + '</td><br>'
                + '<td>' + data.films[i].synopsis + '</td><br>'
                + '<td>' + data.films[i].first_name + '</td><br>'
                + '<td>' + data.films[i].last_name + '</td><br>'
                + '<td>' + Math.trunc(hour) + 'h' + Math.trunc(minutes) + '</td><br></tr>'
            );
          }
        }

      },'json');

      return false;
    });

  });

</script>



</body>
</html>

