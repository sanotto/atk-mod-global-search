# ATK Module Global Search

A module that enables searching all nodes.

## Installation
Just require it with:
```
composer require sanotto\atk-mod-global-search
```
And then, include the module in your **config\atk.php** like this:

```
return [
    'language' => 'en',
 
    'modules' => [
    App\Modules\Setup\Module::class,
    App\Modules\Security\Module::class,
    App\Modules\Home\Module::class,
    sanotto\atkGlobalSearch\Module::class,
.
.
.
```
## Using
A new input box and search butto  will appear next to the logout button.
Entering a word an pressing the search button will search for that word
in every node of your application.
The word will be searched in every attribute that have the AF_SEARCHABLE_FLAG.

### A Requirement ...
Every node has to have a descriptor definition in order to appear in the results list.


