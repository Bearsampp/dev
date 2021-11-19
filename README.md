<p align="center"><a href="https://neard.io/doc/contribute" target="_blank"><img width="100" src="https://neard.io/img/logo-devkit.png"></a></p>
<p align="center">Neard Development Kit</p>

<p align="center">
  <a href="https://github.com/neard/dev/releases/latest"><img src="https://img.shields.io/github/tag/neard/dev.svg?style=flat-square" alt="Tag"></a>
  <a href="https://github.com/sponsors/crazy-max"><img src="https://img.shields.io/badge/sponsor-crazy--max-181717.svg?logo=github&style=flat-square" alt="Become a sponsor"></a>
  <a href="https://www.paypal.me/crazyws"><img src="https://img.shields.io/badge/donate-paypal-00457c.svg?logo=paypal&style=flat-square" alt="Donate Paypal"></a>
</p>

## About

This a sub-repo of [Neard project](https://github.com/neard/neard) involving the Development Kit required for everyone who wants to contribute!<br />
Issues must be reported on [Neard repository](https://github.com/neard/neard/issues).

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

### N6REJ's Instructions...
####Configuration
Fork and clone the module of your choice.
Clone dev in the parent folder of the module.
Create a new pull request with your work.
For example :
```text
cd C:\work\
git clone --recursive https://github.com/neard/module-adminer.git
git clone --recursive https://github.com/neard/dev.git
cd module-adminer\
```

Directory structure example :
```text
[-] dev
 | [-] build
 |  |  | build-commons.xml 
[-] neard-{bin|app|tool}-{name}
 |  | build.xml
 ```

 <hr>
Increment the build.release in the build.properties file. ( check previous version for proper r# )
If you want you can change the build.path (default <i>was</i> "C:\neard-build" but now is "E:\\Development\\MY_PROJECTS\\neard-development\\neard-build").


 ####There is currently an issue where you have put the new release ( such as https://github.com/N6REJ/modules-untouched/releases/tag/git-2.34.0 ) into git and THEN modify
 "https://github.com/N6REJ/modules-untouched/tree/master/modules"/.properties file pointing to the new release.  
 There has to be a better way to do this...
Not doing this step will prevent you from creating the ant release.  I spent hours trying to figure this out.
I think a better ant script could take this into consideration automatically.
but idk how to build such a thing.
<hr>
Open a command prompt in your module folder and run the ant builder with  "ant release"

Upload your release on a file hosting system like Sendspace. or your repo and create an issue asking for a merge.
Create an issue on my Neard fork ( https://github.com/N6REJ/neard/issues ) repository to integrate your release.

## License

LGPL-3.0. See `LICENSE` for more details.<br />
Icon credit to [Juliia Osadcha](https://www.iconfinder.com/iconsets/web-ui-3).