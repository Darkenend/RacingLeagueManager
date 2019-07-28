# Contributing to this Project

## Index

1.  [Workflow](#workflow)
1.  [Project Structure](#project-structure)
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

### Project Structure

The Project follows the structure defined by [PHP Package Development Standards](http://php-pds.com/) on the file side, along with the [Semantic Versioning](https://semver.org/) definitions for version numbers. What this means is that the project will follow this:

#### File Structure

| Package root-level directory for... | ...named     |
|:------------------------------------|:-------------|
| Command-Line Executables            | `bin/`       |
| Configuration Files                 | `config/`    |
| Documentation Files                 | `docs/`      |
| Web Server Files                    | `public/`    |
| Other Resource Files                | `resources/` |
| PHP Source Code                     | `src/`       |
| Test Code                           | `tests/`     |

#### Version Numbers

Example: `1.1.0-rc1`

Syntax: `X.Y.Z-postfix`

| Number  | Meaning                |
|:--------|:-----------------------|
| X       | Major                  |
| Y       | Minor                  |
| Z       | Hotfix                 |
| postfix | Additional Information |

##### Major
Big leap in the project, an overhaul.

##### Minor
Small leap in the project, new features.

##### Hotfix
Self explanatory, only intended to be increased with [hotfixes](https://en.wikipedia.org/wiki/Hotfix).

##### Postfix
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