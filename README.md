<p align="center"><a href="https://bearsampp.com/contribute" target="_blank"><img width="250" src="img/Bearsampp-logo.svg"></a></p>
<p align="center">Bearsampp Development Kit</p>

<p align="center">
  <a href="https://github.com/bearsampp/dev/releases/latest"><img src="https://img.shields.io/github/tag/bearsampp/dev.svg?style=flat-square" alt="Tag"></a>
  <a href="https://github.com/sponsors/N6REJ"><img src="https://img.shields.io/badge/sponsor-N6REJ-181717.svg?logo=github&style=flat-square" alt="Become a sponsor"></a>
  <a href="https://www.paypal.me/BearLeeAble"><img src="https://img.shields.io/badge/donate-paypal-00457c.svg?logo=paypal&style=flat-square" alt="Donate Paypal"></a>
</p>

## About

This a sub-repo of [Bearsampp project](https://github.com/bearsampp/bearsampp) involving the Development Kit required for everyone who wants to contribute!<br />
Issues must be reported on [Bearsampp repository](https://github.com/bearsampp/bearsampp/issues).

## Requirements

### OpenJDK

You need OpenJDK 11 that you can download [here](https://download.java.net/java/GA/jdk11/9/GPL/openjdk-11.0.2_windows-x64_bin.zip).<br />
Extract the archive on your computer (eg. `C:\jdk`) and add the path to `java.exe` (eg. `C:\jdk\bin`) to your environment variable PATH.<br />
To check if you have Java in your path, open a command prompt and type `java -version` :

```text
openjdk version "11.0.2" 2019-01-15
OpenJDK Runtime Environment 18.9 (build 11.0.2+9)
OpenJDK 64-Bit Server VM 18.9 (build 11.0.2+9, mixed mode)
```

### Apache Ant

[Apache Ant](https://ant.apache.org/) is used with the OpenJDK to build and package the portapp.<br />
You need at least Apache Ant 1.10.5 that you can download on the [Apache website](https://ant.apache.org/bindownload.cgi).<br />
Extract the archive on your computer (eg. `C:\apache-ant`) and add the path to `ant.bat` (eg. `C:\apache-ant\bin`) to your environment variable PATH.<br />
To check if you have Apache Ant in your path, open a command prompt and type `ant -version` :

```text
Apache Ant(TM) version 1.10.5 compiled on July 10 2018
```

### Bear's Instructions...
<hr>

#### Configuration
Fork and clone the module of your choice.
Clone dev in the parent folder of the module.
Create a new pull request with your work.

For example :
```text
cd C:\work\
git clone --recursive https://github.com/bearsampp/module-adminer.git
git clone --recursive https://github.com/bearsampp/dev.git
cd module-adminer\
```


Directory structure example :
```text
[-] dev
 | [-] build
 |  |  | build-commons.xml 
[-] bearsampp-{bin|app|tool}-{name}
 |  | build.xml
 ```

 <hr>
 
Increment the build.release in the build.properties file. ( check previous version for proper r# )
If you want you can change the build.path in the build-commons.properties file By default it will be in the same folder tree as your current module.

If the folder does not exist it will be created during build time.

```Text
# The build path (was default C:/bearsampp-build)
build.path = ${project.basedir}/../bearsampp-build
```
<img width="559" alt="image" src="https://user-images.githubusercontent.com/1850089/193386770-ac8fb32d-1396-436b-bc18-cfd7833793ab.png">



 <b>There is currently an issue where you have put the new release ( such as https://github.com/bearsampp/modules-untouched/releases/tag/git-2.34.0 ) into git and THEN modify
 the corresponding *.properties file pointing to the new release.</b>

 <i>There has to be a better way to do this...</i>

Not doing this step will prevent you from creating the ant release.  I spent hours trying to figure this out.
I think a better ant script could take this into consideration automatically.
but idk how to build such a thing.
<hr>
Open a command prompt in your module folder and run the ant builder with  "ant release"

Create an issue on my bearsampp fork ( https://github.com/bearsampp/bearsampp/issues ) repository with your files requesting a release or create a release on your fork and create a pr.
<hr>

### TS vs NTS
After reviewing https://windows.php.net/download/ it appears TS ( thread safe ) builds are whats desired.

## License

GPL-3.0. See `LICENSE` for more details.<br />
