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
  text:
    label: Text
    type: textarea
  timezone:
    label: Zeitzone
    type: text
    width: 3/4
    required: true
    help: >
      Eine Übersicht über alle Zeitzonen gibt's <a href="/calendar/timezones" title="Zeitzonen" target="timezones">hier</a>.
  date:
    label: Stand des Kalenders
    type: date
    width: 1/4
  seo: seo
