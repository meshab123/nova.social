<?php

class Event {

    public $events;
    public $event_count = 0;

    public function __construct() {
        // load meetup data into associative array
        $json = file_get_contents("../vendor/usaws/data/events.json");
        $this->events = json_decode($json, true);
        $this->event_count = count($this->events);
    }

    public function write_title($event_id) {
        return $this->events[$event_id]['title'];
    }

    public function write_date($event_id) {
        $original_date = $this->events[$event_id]['date'];
        $new_date = date("n/j/Y", strtotime($original_date));
        return $new_date;
    }

    public function write_time($event_id) {
        $original_date_and_time = $this->events[$event_id]['date']. " ".$this->events[$event_id]['start_time'];
        $new_date = date("ga", strtotime($original_date_and_time));
        return $new_date;
    }

    public function write_meetup_url($event_id) {
        $event_id = $this->events[$event_id]['event_id'];
        $link = "https://www.meetup.com/Nova-Social/events/".$event_id."/";
        return $link;
    }

    public function write_meetup_url_display($event_id) {
        $event_id = $this->events[$event_id]['event_id'];
        return $event_id;
    }

    public function write_presentation_url($event_id) {
        $url = $this->events[$event_id]['presentation'];
        if (is_null($url)) {
            return "---";
        } else {
            return $url;
        }
    }

    public function write_presentation_url_display($event_id) {
        $presentation = $this->events[$event_id]['presentation'];
        return $presentation;
    }

    public function write_video_url($event_id) {
        $url = $this->events[$event_id]['video_url'];
        if (is_null($url)) {
            return "---";
        } else {
            return $url;
        }
    }

    public function write_video_url_display($event_id) {
        $video_url = $this->events[$event_id]['presentation'];
        return $video_url;
    }

}
