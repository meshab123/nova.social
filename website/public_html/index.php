<?php
require_once("../vendor/usaws/classes/meetings.php");
require_once("../vendor/usaws/classes/events.php");

$meeting = new Meeting;
$event = new Event;
?>
<!doctype html>
<html lang="en">
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Nova.Social Philosophy Discussion Group</title>
  <meta name="description" content="Nova.Social Philosophy Discussion Group">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="css/main.css">

  <!--[if lt IE 9]>
  <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
  <link rel="shortcut icon" href="media/images/favicon.ico">
  <![endif]-->
  <!-- Touch Icons - iOS and Android 2.1+ 180x180 pixels in size. -->
  <link rel="apple-touch-icon-precomposed" href="media/images/apple-touch-icon-precomposed.png">
  <!-- Firefox, Chrome, Safari, IE 11+ and Opera. 196x196 pixels in size. -->
  <link rel="icon" href="media/images/favicon.png">
</head>


<body>
  <!--[if lt IE 7]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->

  <nav class="navbar navbar-inverse navbar-fixed-left">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#logo">Nova.Social</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li><a href="#meetings">Meetings (<?php echo $meeting->meeting_count; ?>)</a></li>
          <li><a href="#events">Events (<?php echo $event->event_count; ?>)</a></li>
          <li><a href="#">Contact Us</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li role="separator" class="divider"></li>
              <li class="dropdown-header">Nav header</li>
              <li><a href="#">Separated link</a></li>
              <li><a href="#">One more separated link</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main id="content" style="text-align:center; margin:10px;" class="main">
    <div style="max-width: 1000px; margin:0 auto; text-align:center;">
      <p>
        <a name="logo"><img style="max-width:100%; height:auto; border:0;" src="media/images/nova-social-logo.jpg" width="1000" alt="Nova Social Philosophy Group Logo">
      </p>
      <h4 style="text-align: left"><a name="meetings">Meetup.com Meetings</a></h4>
      <table class="table-sm table table-striped table-bordered">
        <tr>
          <th class="text-center">Date</th>
          <th class="text-center">Time</th>
          <th class="text-center">Title</th>
          <th class="text-center">Meetup</th>
          <th class="text-center">Presentation</th>
          <th class="text-center">Video Link</th>
        </tr>
<?php foreach ($meeting->meetings as $meeting_id => $meeting_details) { ?>
        <tr>
          <td><?php echo $meeting->write_date($meeting_id); ?></td>
          <td><?php echo $meeting->write_time($meeting_id); ?></td>
          <td><?php echo $meeting->write_title($meeting_id); ?></td>
          <td><a href="<?php echo $meeting->write_meetup_url($meeting_id); ?>" target="blank"><?php echo $meeting->write_meetup_url_display($meeting_id); ?></a></td>
          <td>Presentation</td>
          <td>Video Link</td>
        </tr>
<?php } ?>
      </table>

      <h4 style="text-align: left; margin-top:1000px;"><a name="events">Community Events</a></h4>
      <table class="table-sm table table-striped table-bordered">
        <tr>
          <th class="text-center">Date</th>
          <th class="text-center">Time</th>
          <th class="text-center">Title</th>
          <th class="text-center">Meetup</th>
        </tr>
<?php foreach ($event->events as $event_id => $event_details) { ?>
        <tr>
          <td><?php echo $event->write_date($event_id); ?></td>
          <td><?php echo $event->write_time($event_id); ?></td>
          <td><?php echo $event->write_title($event_id); ?></td>
          <td><a href="<?php echo $event->write_meetup_url($event_id); ?>" target="blank"><?php echo $event->write_meetup_url_display($event_id); ?></a></td>
        </tr>
<?php } ?>
      </table>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h4 style="text-align:left">Nova Social Contact Form</h4>
                <form id="contact-form" method="post" action="contact.php" role="form">
                    <div class="messages"></div>
                    <div class="controls">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_name">Firstname *</label>
                                    <input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter your firstname *" required="required" data-error="Firstname is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_lastname">Lastname *</label>
                                    <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="Please enter your lastname *" required="required" data-error="Lastname is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_email">Email *</label>
                                    <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email *" required="required" data-error="Valid email is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_phone">Phone</label>
                                    <input id="form_phone" type="tel" name="phone" class="form-control" placeholder="Please enter your phone">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form_message">Additional Information</label>
                                    <textarea id="form_message" name="message" class="form-control" placeholder="Additional information you'd like to share." rows="4" data-error="Please leave us a message."></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-success btn-send" value="Send message">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-muted"><strong>*</strong> These fields are required.</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- /.8 -->
        </div> <!-- /.row-->
    </div> <!-- /.container-->






  </main>





  <footer class="footer">
    <div class="inner">
      <!-- <p>Footer <button class="add">Add Content</button></p> -->
      <p>Nova Social is a project of USA Web School, a 501(3)(c) Charity <a href="https://www.usawebschool.org/donate" target="_blank"><span style="color: yellow">Please DONATE</span></a></p>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.2.1.min.js"
          integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
          crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
          integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
          crossorigin="anonymous"></script>

  <script src="js/vendor/bigSlide.min.js"></script>

  <script>
    $(document).ready(function() {
      $('.menu-link').bigSlide();
    });
  </script>
</body>
</html>
