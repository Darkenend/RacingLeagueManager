# Contributing to this Project

## Index

1.  [Workflow](#workflow)
1.  [Coding-style](#coding-style)
1.  [Commit Style](#commit-style)

### Workflow

The workflow followed will be the Gitflow Workflow, popularized [here](https://nvie.com/posts/a-successful-git-branching-model/), and summed up with the following short lines:

1.  `develop` branch is created from `master`
1.  `release` branch is created from `master`
1.  `feature` branches are created from `develop`
1.  When a `feature` is complete, it's merged into `develop`
1.  When a `release` is done, it's merged into `develop` and `master`
1.  If an issue in `master` is detected, a `hotfix` branch is created from `master`
1.  Once `hotfix` is complete, it's merged to `develop` and `master`

<sub>[Back to the top](#index)</sub>

#### Branch Structure

There will be a few examples on each thing
*   master
*   hotfix
    *   crash-on-linux
    *   wrong-color
*   release
    *   0.1
    *   0.2
    *   0.3
    *   0.4
*   develop
*   feature
    *   search-bar
    *   login
    *   parallax-at-index

### Coding Style

* 4 Spaces for Indentation
* UNIX-style Newlines
* No trailing white spaces
* Use Semicolons
* 80 Characters per line
* Use single quotes
* Opening Braces go on the same line
* 1 Variable per statement

#### Naming Conventions

* Variables, Properties, Functions = lowerCamelCase
* Classes = UpperCamelCase
* Constants = UPPERCASE

#### Variables

##### Object/Array Creation
Use trailing commas and put short declarations on a single line. Only quote keys when your interpreter complains:
```javascript
var a = ['good', 'example'];

var b = {
   good: 'code',
   'should be': 'pretty',
};
```

#### Conditionals

##### Use the === operator
Programming is not about remembering stupid rules, use strict equality to make sure that it works properly.

```javascript
var a = 0;

if (a !== '') {
   console.log('winning');
}
```

##### Use descriptive conditions
If a condition isn't trivial, give it a descriptive named variable or function

```javascript
var isValidPassword = password.length >= 4 && /^(?=.*\d).{4,}$/.test(password);

if (isValidPassword) {
  console.log('winning');
}
```

#### Functions

##### Write small functions
Keep your functions short, that way if it blows up, you'll know where it does more accurately and why.

##### Return early from functions
Avoid deep nesting of if statements and such

```javascript
function isPercentage(val) {
   var isInRange = (val >= 0 && val <= 100);
   return isInRange;
}
```

##### Method Chaining
One method per line should be used if you absolutely need to. Indent the methods so it's easier to tell they're part of the same chain.

```javascript
User

.findOne({ name: 'foo' })

.populate('bar')

.exec(function(err, user) {

return true;

});
```

#### Comments

##### Use Slashes for Comments
Try to write comments that explain higher level mechanism, or clarify difficult segments, don't restate trivial things.

```javascript

// 'ID_SOMETHING=VALUE' -> ['ID_SOMETHING=VALUE',
// 'SOMETHING', 'VALUE']
var matches = item.match(/ID_([^\n]+)=([^\n]+)/));

// This function has a nasty side effect where a failure to
// increment a redis counter used for statistics will
// cause an exception. This needs to be fixed in a later iteration.
function loadUser(id, cb) {
   // ...
}
```

#### Requires on top
Always put requires at top to illustrate a file's dependencies clearly, on an alphabetical order.

### Version Numbers

Example: `1.1.0-rc1`

Syntax: `X.Y.Z-postfix`

| Number  | Meaning                |
|:--------|:-----------------------|
| X       | Major                  |
| Y       | Minor                  |
| Z       | Hotfix                 |
| postfix | Additional Information |

#### Major
Big leap in the project, an overhaul.

#### Minor
Small leap in the project, new features.

#### Hotfix
Self explanatory, only intended to be increased with [hotfixes](https://en.wikipedia.org/wiki/Hotfix).

#### Postfix
Rarely used, will mostly be used upon reaching [major](#major) updates with the `rcx` postfix, being x a number starting from 1 all the way to infinity if need be, meaning "Release Candidate"

<sub>[Back to the top](#index)</sub>

### Commit Style

The first line of a commit message serves as a summary.  When displayed on the web, it's often styled as a heading, and in emails, it's typically used as the subject.

As such, you should capitalize it and omit any trailing punctuation. Aim for about 50 characters, give or take, otherwise it may be painfully truncated in some contexts.

Write it, along with the rest of your message, in the imperative tense: "Fix bug" and not "Fixed bug" or "Fixes bug". Consistent wording makes it easier to mentally process a list of commits.

Oftentimes a subject by itself is sufficient.  When it's not, add a blank line (this is important) followed by one or more paragraphs hard wrapped to 72 characters.

Git is strongly opinionated that the author is responsible for line breaks; if you omit them, command line tooling will show it as one extremely long unwrapped line.

Fortunately, most text editors are capable of automating this.

<sub>[Back to the top](#index)</sub>
