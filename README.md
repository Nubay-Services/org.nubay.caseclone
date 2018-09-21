# org.nubay.caseclone

This extension adds two options to the Actions menu for the Case entity. To use these Actions, go to /civicrm/case/search?reset=1 and find the case(s) you'd like to clone. Select the case(s) you'd like to clone and choose one of the options from the 'Actions' menu.

  - Clone Case (Clone Activities)
      Clones the case e.g. contacts, custom field values, title, dates, etc AND any activities attached to that case

  - Clone Case (Default Activities)
      Clones the case e.g. contacts, custom field values, title, dates, etc but with only the default activities set for that case type

## Requirements

* PHP v5.4+
* CiviCRM (4.7.x +)

## Installation (Web UI)

This extension has not yet been published for installation via the web UI.

## Installation (CLI, Zip)

Sysadmins and developers may download the `.zip` file for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
cd <extension-dir>
cv dl org.nubay.caseclone@https://github.com/Nubay-Services/org.nubay.caseclone/archive/master.zip
```

## Installation (CLI, Git)

Sysadmins and developers may clone the [Git](https://en.wikipedia.org/wiki/Git) repo for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
git clone https://github.com/Nubay-Services/org.nubay.caseclone.git
cv en caseclone
```
