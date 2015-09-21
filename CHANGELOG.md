# CHANGELOG

## develop branch

### Backwards-Compatibility Breaks

Split the namespaces up into:

* Cli - support for the Git command-line tool
* Repo - operations on the Git repository
* WorkingTree - operations on the working tree (i.e. on checked-out files and branches)

As a result, the following classes have been renamed:

Old Name | New Name
---------|----------
`Checks\IsGitRepo` | `Repo\Checks\IsGitRepo`
`Exec\ExecInGitRepo` | `Cli\ExecGit`
`Requirements\RequireGitRepo` | `Repo\Requirements\RequireGitRepo`
`ValueBuilders\GetAllBranchesList` | `Repo\ValueBuilders\GetAllBranchesList`
`ValueBuilders\GetCurrentBranch` | `WorkingTree\ValueBuilders\GetCurrentBranch`
`ValueBuilders\GetLocalBranchesList` | `Repo\ValueBuilders\GetLocalBranchesList`

`ValueBuilders\GetRemoteBranchesList` | `Repo\ValueBuilders\GetRemoteBranchesList`
`ValueBuilders\GetTagList` | `Repo\ValueBuilders\GetTagList`

### New

* Added `ValueBuilders\GetCurrentBranch`
* Added `ValueBuilders\GetTagList`

### Fixes

* Switched to putting the branch names as keys for `GetLocalBranchesList`, `GetRemoteBranchesList` and `GetAllBranchesList` to speed things up
* Switched to putting the tag names as keys for `GetTagList` to speed things up
* `Repo\Checks\IsGitRepo` - updated to support latest Filesystem release

## 0.1.0 - Sun 20 Sep 2015

### New

* Added `Checks\IsGitRepo`
* Added `Exceptions\Exxx_GitRepoException`
* Added `Exceptions\E4xx_GitRepoException`
* Added `Exceptions\E4xx_NotGitRepo`
* Added `Exceptions\E4xx_UnsupportedType`
* Added `Exec\ExecInGitRepo`
* Added `Requirements\RequireGitRepo`
* Added `ValueBuilders\GetAllBranchesList`
* Added `ValueBuilders\GetLocalBranchesList`
* Added `ValueBuilders\GetRemoteBranchesList`
