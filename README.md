# Admnote plugin for DokuWiki

## Description

This plugin adds **Material-for-MkDocs Admonition notes** to Dokuwiki (<https://squidfunk.github.io/mkdocs-material/reference/admonitions/>).

Not all features of the Material-for-MkDocs Admonition notes are supported. Notes are not collapsible and you cannot omit the header line.

Some note styles had to be renamed to avoid conflicts with existing DokuWiki base styles.

## License

This plugin is published under the Gnu Public License (GPL) V2.

CSS-Code: © 2016-2020 Martin Donath. Available under MIT License

Material Icons: © Google Inc. Available under Apache license version 2.0

## Installation

Unpack the file in the `/lib/plugin` directory of your Dokuwiki installation. It will create a directory named admnote there. You can also use the extension manager.

## Syntax

This plugin uses the `<adm></adm>` tag pair to start and end a note. The first parameter of the opening tag chooses the note style.

There are twelve styles available: 'abstract', 'bug', 'danger', 'example', 'failure', 'information', 'note', 'question', 'quote', 'achievement', 'tip', 'warning'

### Custom heading

You can replace the standard heading by adding your heading text as a third parameter in the `<adm>` tag:

`<adm warning A very special warning>This is a warning</adm>`

There is no need for quotes in your heading. You cannot use wiki styles in the heading.

### Notes without body

You can also omit the body of the note completely:

`<adm danger Will initiate self destruction if you click this></adm>`

### Default note style

The default style is 'note', so `<adm></adm>` is a valid note although it does not make much sense.

The default style will also be used if you mistype a style.

### Note body

You can use almost every DokuWiki element inside a note body except headers.

## Dokuwiki compatibility

This plugin was made for DokuWiki Release 2020-07-29 "Hogfather". It may work with earlier releases but that is untested.

## ToDo

* Support export into ODT format
* Support more languages (help needed)
