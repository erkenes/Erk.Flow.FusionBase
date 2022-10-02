Flow Fusion Base
----------------------------

This repository is a **read-only subsplit** of the [Erk.Flow.BaseDevelopment](https://github.com/erkenes/Erk.Flow.BaseDevelopment)-Repository.

This package provides some basic files to render fusion files within the Flow-Framework.

Contribute
----------

If you want to contribute to this package, please have a look at
[Erk.Flow.BaseDevelopment](https://github.com/erkenes/Erk.Flow.BaseDevelopment) - it is the repository
used for development and all pull requests should go into it.

---

## Usage

Add the Fusion standalone View to your controller.

```php
<?php
namespace Foo\Bar;

use Neos\Flow\Mvc\Controller\ActionController;
use Neos\Fusion\View\FusionView;

class SomeCustomController extends ActionController
{
    protected $defaultViewObjectName = FusionView::class;
    
    public function indexAction(): void
    {
        $this->view->assign('someControllerVariable', 'the value');
    }
}
```

Create a Fusion file for the controller:

```neosfusion
// Includes required fusion prototypes
include: resource://Erk.Flow.FusionBase/Private/Fusion/Root.fusion

// [Package-Key].[ControllerName].[ActionName]
Foo.Bar.SomeCustomController.index = Erk.Flow.FusionBase:Presentation.Page.DefaultPage {
    // API
    variableOfThePrototype = 'defaultValue'

    body {
        content = Foo.Bar:Presentation.Organism.SomeCustomController.IndexAction {
            variableOfThePrototype = ${variableOfThePrototype}

            // will be set with $this->view->assign() in the controller
            someControllerVariable = ${someControllerVariable}
        }
    }
  
    // Variables of the prototype must be added to the context
    // to use them in `body`
    @context {
        variableOfThePrototype = ${this.variableOfThePrototype}
    }
}
```

```neosfusion
prototype(Foo.Bar:Presentation.Organism.SomeCustomController.IndexAction) < prototype(Neos.Fusion:Component) {
    // API
    variableOfThePrototype = 'defaultValue'
    someControllerVariable = 'defaultValue'
  
    // Rendering
    renderer = afx`
        Prototype-Variable: {props.variableOfThePrototype}<br />
        Controller-Value: {props.someControllerVariable}
    `
}
```

### Flash-Messages

To render Flash-Messages as bootstrap alerts in the frontend:

```neosfusion
<Erk.Flow.FusionBase:Content.FlashMessages />
```
