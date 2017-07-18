# ATK Module Global Search

A module that enables searching all nodes.

## Installation
Just require it with:
```
composer require sanotto\atk-mod-global-search @dev
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

### A Bonus ...
You can implement a method called **searchdescriptor** in your node i.e.:

```
public function searchdescriptor($record)
{
    $content = "This is the search description for this record:";
    $content.= "<hr>";
    $content.= "Name:".$record['name'];
    $content.= "<hr>";
    return $content;
}
```
So you can return the description formatted as you wish, if you do not implement **searchdescriptor** in your node, the standard descriptor will be used instead. Using a custom search descriptor allows for very fine grained result display.
