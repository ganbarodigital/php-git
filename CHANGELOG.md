# CHANGELOG

## develop branch

### New

* Added `ValueBuilders\GetCurrentBranch`
* Added `ValueBuilders\GetTagList`

### Fixes

* Switched to putting the branch names as keys for `GetLocalBranchesList`, `GetRemoteBranchesList` and `GetAllBranchesList` to speed things up
* Switched to putting the tag names as keys for `GetTagList` to speed things up

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
