# Changelog

## 5.5 ( 03 Dec 21)
* Finished renaming neard to "Bearsampp"
* Updated logo to follow whats set in .settings
* Fixed sponsor links

## 5.4.0 (22 Nov 21)
* Changed to local installation of 7z for ease in maintenance
* Changed to local build dir
* Updated libs

## 5.3.0 (2020/12/13)

* Switch to GitHub Actions (neard/neard#470)

## 5.2.0 (2020/04/19)

* Remove Drush, PhpMetrics, PHPUnit and WP-CLI modules (neard/neard#453)
* Update libs

## 5.1.0 (2020/04/05)

* Replace Console with ConsoleZ (neard/neard#406)
* Fix ant-contrib download link

## 5.0.1 (2019/05/25)

* Update ant-contrib url

## 5.0.0 (2019/05/24)

* Switch to TravisCI
* Update 7zip, InnoExtract, InnoSetup

## 4.1.0 (2017/12/28)

* Revert build path
* Add ngrok module (neard/neard#334)

## 4.0.0 (2017/11/24)

* Move neard repositories to its own organization (neard/neard#339)
* Remove HostsEditor module (add in core instead) (neard/neard#329)

## 3.8.0 (2017/09/03)

* Remove ImageMagick (neard/neard#322)

## 3.7.0 (2017/09/01)

* Remove Notepad2-mod (neard/neard#314)

## 3.6.1 (2017/07/30)

* Use lessmsi instead of msiexec

## 3.6.0 (2017/07/23)

* Add Ghostscript module (neard/ghostscript#220)

## 3.5.0 (2017/07/15)

* Replace default Console version

## 3.4.0 (2017/07/11)

* More efficient 7zip extract command
* Add Perl module (neard/neard#155)

## 3.3.1 (2017/06/20)

* Update 7zip and Composer

## 3.3.0 (2017/06/18)

* Add Yarn module (neard/neard#157)

## 3.2.3 (2017/06/17)

* Bug while extracting msi

## 3.2.2 (2017/05/05)

* Update 7zip-extra download url

## 3.2.1 (2017/04/20)

* Update defaultexcludes

## 3.2.0 (2017/04/16)

* Load environment variables through Ant property
* Do not use minor when building snapshot release (neard/neard#247)
* Review versioning style (neard/neard#247)

## 3.1.0 (2017/04/10)

* Use 7zip as external lib

## 3.0.1 (2017/03/12)

* Add MongoDB releases infos
* Small issue with download archive bool

## 3.0.0 (2017/03/11)

* Small refactoring
* Add download macrodef
* Update PHP to 5.6.29
* Update defaultexcludes
* Change tmp path location
* Add extract msi task
* Add versioncompare scriptdef

## 2.6.0 (2017/02/10)

* Add composer task

## 2.5.0 (2017/01/30)

* Create checksum for downloads (Issue neard/neard#211)
* Update bootstrap dev
* Update default excludes
* Update libs links

## 2.4.0 (2016/11/09)

* Add Python, Ruby and SVN releases infos
* Use 7zip to create zip archives
* Update 7zip to 16.04

## 2.3.0 (2016/10/22)

* Add build-misc and innosetup / innoextract libs

## 2.2.0 (2016/07/14)

* Add Notepad2-mod, Memcached and phpMemAdmin releases infos
* Add .gitkeep to default excludes

## 2.1.0 (2016/04/30)

* Add Drush, PHPUnit and WP-CLI releases infos

## 2.0.0 (2016/04/22)

* Add task to build Neard
* Add task to launch Neard
* Add task to check languages files 
* Add PHP tool

## 1.2.0 (2016/04/17)

* Add input in bundle release task to choose one or every versions to build for a bundle

## 1.1.0 (2016/04/12)

* Upgrade 7zip tool from 9.20 to 15.14

## 1.0.0 (2016/04/10)

* Init repo with basic ANT tasks to build bundles
