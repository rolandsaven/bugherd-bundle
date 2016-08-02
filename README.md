# BugherdBundle

This is a Symfony 2-3 bundle to interact with the Bugherd API v2 via  [php-bugherd-api](https://github.com/beleneglorion/php-bugherd-api).

## Requirements

- A Bugherd account
- PHP 5.5+
- Symfony 2.8+



## Installation

Use [Composer](https://getcomposer.org) to add this bundle to your Symfony application.

Add `rolandsaven/bugherd-bundle` to your **composer.json** file:

```json
{
    "require": {
        "rolandsaven/bugherd-bundle": "dev-master"
    }
}
```


Edit `AppKernel.php` by inserting the following:

```php
public function registerBundles()
{
    $bundles = array(
        // ...
            new RolandSaven\BugherdBundle\BugherdBundle(),
        // ...
    );
}
```

Obtain your BugHerd Api Key and add it to `config.yml`:

```yaml
bugherd:
    api_key: your_bugherd__api_key
```

Finally, run `composer update`.

## Accessing the Bugherd API

In a controller you can access the Bugherd client and the API resources
as follows: 

```php
// Get the BugHeard Api Client
$bugherd = $this->get('bugherd');

/** Projects **/
// Get all projects
$projects = $bugherd->api('project')->all();

// Get all active projects
$active_projects = $bugherd->api('project')->allActive();

// Get all projects with name/id pairs
$projects = $bugherd->api('project')->listing($forceUpdate, $reverse);

// Get all active projects with name/id pairs
$active_projects = $bugherd->api('project')->listingActive($forceUpdate, $reverse);

// Get project id given its name
$id = $bugherd->api('project')->getIdByName($name);

// Get a project
$project = $bugherd->api('project')->show($id);

// Create a project
$project = $bugherd->api('project')->create(array(
    'name'      => 'Name of the Project',
    'devurl'    => 'http://example.com/',
    'is_active' => true,
    'is_public' => false,
));

/** Users **/
// Get all users
$users = $bugherd->api('user')->all();

// Get all guests
$guests = $bugherd->api('user')->getGuests();

// Get all members
$members = $bugherd->api('user')->getMembers();

/ Tasks **/
// Get a task
$task = $bugherd->api('task')->show($projectId, $taskId);

// Create a task
$task = $bugherd->api('task')->create($projectId, array(
    'description'      => 'Some description',
    'requester_id'     => $requester_id,
    'requester_email'  => $requester_email
));

// Update a task
$task = $bugherd->api('task')->update($projectId, $taskId, array(
    'description'      => 'Some new description',
));

// Get all tasks
$tasks = $bugherd->api('task')->all($projectId, array(
    'status' => 'backlog',
    'priority' => 'critical'
));

/** Organization **/
// Get organization information
$organization = $bugherd->api('organization')->show();

/** Comments **/
// Create a comment
$comment = $bugherd->api('comment')->create($projectId, $taskId, array(
    'text'      => 'some comment',
    'user_id'     => $user_id,
    'user_email'  => $user_email
));

// Get all comments
$comments = $bugherd->api('comment')->all($projectId, $taskId);


/** Webhooks **/
// Get all webhooks
$webhooks = $bugherd->api('webhook')->all();

// Create a webhook
$webhook = $bugherd->api('webhook')->create(array(
    'target_url' => 'http://example.com/tasks/create',
    'event' => 'task_create' // this could be task_update, task_destroy, comment
));

// Delete a webhook
$bugherd->api('webhook')->remove($webhookId);
```

## Contributing

This library is still work in progress.PR-s are welcome both here and for the PHP SDK [php-bugherd-api](https://github.com/beleneglorion/php-bugherd-api).

## Author

The library was written and maintained by [Roland Kalocsaven](https://github.com/rolandsaven) 
from [Onwwward](http://onwwward.com).

## References

* [PHP BugHerd API](https://github.com/beleneglorion/php-bugherd-api)
* [BugHerd API v2 Documentation](https://www.bugherd.com/api_v2)