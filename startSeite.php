<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>iGOAL-Game</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <style>
.button {
  background-color:#E76F51;"
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>
  </head>

  <body>
  <div class="content-full valign-wrapper center-align">
    <div class="select-profile teal">
      <div class="row">
        <h3 style="color:blue;">Welcome</h3>
      </div>
      <div class="row">
        <div class="container"><h5>Please select your avatar and id player!</h5></div>
      </div>
      <div class="row">
        <div class="col s12">
          <img class="img-select-avatar" style="height:50px; width:50px" src="./assets/images/avatar-f-young.png" alt="female young avatar">
          <img class="img-select-avatar" style="height:50px; width:50px" src="./assets/images/avatar-m-senior.png" alt="male senior avatar">
          <img class="img-select-avatar" style="height:50px; width:50px" src="./assets/images/avatar-m-young.png" alt="male young avatar">
        </div>
      </div>
      <div class="row">
        <form action="#">
          <p>
            <label>
              <input name="group1" type="radio" />
              <span style="color:white;">Senior (age) collaborators</span>
            </label>
          </p>
          <p>
            <label>
              <input name="group1" type="radio" />
              <span style="color:white;">Younger (age) collaborators</span>
            </label>
          </p>
        </form>
      </div>
      <div class="max-half row valign-wrapper center center-align">
        <div class="col s12 m9 l9">
          <div class="input-field" >
            <input id="game_id" type="text" class="validate">
            <label for="game_id">type your (nick) name</label>
          </div>
        </div>
        </div>
        <div class="col s12 m3 l3" style="  text-align: center;" >
          <button class="btn waves-effect centered-button" type="button"  name="button">save profile</button>
        </div>

    </div>
  </div>
  <script type="text/javascript" src="/assets/igoal-game.js"/></script>
  </body>
</html>
