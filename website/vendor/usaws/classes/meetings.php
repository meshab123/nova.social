<?php

class Meeting {

    //array to hold the various key / values associated with a meeting
    public $meetings;
    public $meeting_count = 0;

    public function __construct() {
        // load meetup data into associative array
        $json = file_get_contents("../vendor/usaws/data/meetups.json");
        $this->meetings = json_decode($json, true);
        $this->meeting_count = count($this->meetings);
    }

    public function write_title($meeting_id) {
        return $this->meetings[$meeting_id]['title'];
    }

    public function write_date($meeting_id) {
        $original_date = $this->meetings[$meeting_id]['date'];
        $new_date = date("n/j/Y", strtotime($original_date));
        return $new_date;
    }

    public function write_time($meeting_id) {
        $original_date_and_time = $this->meetings[$meeting_id]['date']. " ".$this->meetings[$meeting_id]['start_time'];
        $new_date = date("ga", strtotime($original_date_and_time));
        return $new_date;
    }

    public function write_meetup_url($meeting_id) {
        $event_id = $this->meetings[$meeting_id]['event_id'];
        $link = "https://www.meetup.com/Nova-Social/events/".$event_id."/";
        return $link;
    }

    public function write_meetup_url_display($meeting_id) {
        $event_id = $this->meetings[$meeting_id]['event_id'];
        return $event_id;
    }

    public function write_presentation_url($meeting_id) {
        $url = $this->meetings[$meeting_id]['presentation'];
        if (is_null($url)) {
            return "---";
        } else {
            return $url;
        }
    }

    public function write_presentation_url_display($meeting_id) {
        $presentation = $this->meetings[$meeting_id]['presentation'];
        return $presentation;
    }

    public function write_video_url($meeting_id) {
        $url = $this->meetings[$meeting_id]['video_url'];
        if (is_null($url)) {
            return "---";
        } else {
            return $url;
        }
    }

    public function write_video_url_display($meeting_id) {
        $video_url = $this->meetings[$meeting_id]['presentation'];
        return $video_url;
    }

}
/*
"title":
    "Intelligence and Morality",
    "date": "2017-04-27",
    "start_time": "19:00:00",
    "end_time": "21:00:00",
    "event_id": 239402779,
    "intro": "Does morality in general increase with intelligence? Are intelligent people more likely to be highly moral?",
    "presentation": null,
    "video_url": null,
    "summary": null
*/
