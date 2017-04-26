<?php if(!defined('KIRBY')) exit ?>

title: Calendar
pages:
  template: event
files: true
icon: calendar
fields:
  title:
    label: Überschrift
    type:  text
    width: 3/4
  perpage:
    label: Einträge / Seite
    type: number
    min: 1
    max: 20
    default: 5
    width: 1/4
  date:
    label: Stand des Kalenders
    type: date
  text:
    label: Text
    type: textarea
  subtitle:
    label: Zwischenüberschrift
    type: text
    width: 3/4
  button:
    label: Button-Text
    type: text
    width: 1/4
  webcal_text:
    label: Hovertext fürs Kalendersymbol
    type: text
    width: 1/2
  timezone:
    label: Timezone
    type: text
    width: 1/2
    required: true
    help: >
      Enter a valid <a href="/calendar/timezones" title="Calendar Timezones" target="timezones">DateTimeZone ID</a>.
