# Troubleshooting Guide

Common issues and solutions for the Bearsampp Gradle build system.

## Table of Contents

1. [Installation Issues](#installation-issues)
2. [Build Failures](#build-failures)
3. [Performance Issues](#performance-issues)
4. [Environment Issues](#environment-issues)
5. [Dependency Issues](#dependency-issues)
6. [Task Execution Issues](#task-execution-issues)

## Installation Issues

### "gradle is not recognized"

**Problem:** Gradle command not found in PATH

**Solutions:**

1. **Use Gradle Wrapper (Recommended):**
   ```powershell
   # Windows
   .\gradlew tasks
   
   # Linux/Mac
   ./gradlew tasks
   ```

2. **Add Gradle to PATH:**
   ```powershell
   # Windows (PowerShell as Administrator)
   $env:Path += ";C:\Gradle\bin"
   [Environment]::SetEnvironmentVariable("Path", $env:Path, "Machine")
   
   # Verify
   gradle --version
   ```

3. **Use Full Path:**
   ```powershell
   C:\Gradle\bin\gradle tasks
   ```

4. **Restart Terminal:**
   - Close and reopen PowerShell/Terminal
   - PATH changes require restart to take effect

---

### "JAVA_HOME is not set"

**Problem:** Java environment variable not configured

**Solutions:**

1. **Set JAVA_HOME:**
   ```powershell
   # Windows (PowerShell as Administrator)
   [Environment]::SetEnvironmentVariable("JAVA_HOME", "C:\Program Files\Java\jdk-23", "Machine")
   
   # Linux/Mac
   export JAVA_HOME=/usr/lib/jvm/java-23
   ```

2. **Verify Java Installation:**
   ```powershell
   java -version
   ```

3. **Check Java Path:**
   ```powershell
   # Windows
   echo $env:JAVA_HOME
   
   # Linux/Mac
   echo $JAVA_HOME
   ```

---

### "Unsupported Java version"

**Problem:** Java version is too old

**Requirements:**
- Minimum: Java 11
- Recommended: Java 17 or later
- Tested with: Java 23

**Solutions:**

1. **Check Current Version:**
   ```powershell
   java -version
   ```

2. **Install Newer Java:**
   - Download from: https://adoptium.net/
   - Or: https://www.oracle.com/java/technologies/downloads/

3. **Update JAVA_HOME:**
   ```powershell
   # Point to newer Java installation
   [Environment]::SetEnvironmentVariable("JAVA_HOME", "C:\Program Files\Java\jdk-23", "Machine")
   ```

---

## Build Failures

### "Build failed with exception"

**Problem:** Generic build failure

**Diagnostic Steps:**

1. **Run with Stack Trace:**
   ```powershell
   gradle build --stacktrace
   ```

2. **Run with Debug Output:**
   ```powershell
   gradle build --debug
   ```

3. **Run with Info Output:**
   ```powershell
   gradle build --info
   ```

4. **Check Build Scan:**
   ```powershell
   gradle build --scan
   ```

---

### "Task failed to execute"

**Problem:** Specific task fails

**Solutions:**

1. **Clean and Rebuild:**
   ```powershell
   gradle clean build
   ```

2. **Verify Environment:**
   ```powershell
   gradle verify
   ```

3. **Check Dependencies:**
   ```powershell
   gradle verifyLibs
   ```

4. **Reinitialize:**
   ```powershell
   gradle clean cleanLibs initDirs loadLibs build
   ```

---

### "Cannot find PHP executable"

**Problem:** PHP not found in tools directory

**Solutions:**

1. **Verify PHP Location:**
   ```powershell
   # Check if PHP exists
   Test-Path "E:\Bearsampp-development\dev\tools\php\php.exe"
   ```

2. **Install PHP:**
   - Download PHP from: https://windows.php.net/download/
   - Extract to: `tools/php/`

3. **Verify Installation:**
   ```powershell
   gradle verify
   ```

---

### "Cannot find 7-Zip"

**Problem:** 7-Zip not found in tools directory

**Solutions:**

1. **Verify 7-Zip Location:**
   ```powershell
   Test-Path "E:\Bearsampp-development\dev\tools\7zip\7za.exe"
   ```

2. **Install 7-Zip:**
   - Download from: https://www.7-zip.org/
   - Extract 7za.exe to: `tools/7zip/`

3. **Verify Installation:**
   ```powershell
   gradle verify
   ```

---

## Performance Issues

### "Builds are slow"

**Problem:** Build takes too long

**Solutions:**

1. **Enable Gradle Daemon:**
   ```properties
   # gradle.properties
   org.gradle.daemon=true
   ```

2. **Enable Parallel Execution:**
   ```properties
   # gradle.properties
   org.gradle.parallel=true
   ```

3. **Enable Build Cache:**
   ```properties
   # gradle.properties
   org.gradle.caching=true
   ```

4. **Use Configuration Cache:**
   ```powershell
   gradle build --configuration-cache
   ```

5. **Increase Memory:**
   ```properties
   # gradle.properties
   org.gradle.jvmargs=-Xmx4096m -XX:MaxMetaspaceSize=1024m
   ```

6. **Use Parallel Workers:**
   ```powershell
   gradle build --parallel --max-workers=4
   ```

---

### "Gradle daemon keeps dying"

**Problem:** Daemon crashes or stops unexpectedly

**Solutions:**

1. **Stop Daemon:**
   ```powershell
   gradle --stop
   ```

2. **Increase Daemon Memory:**
   ```properties
   # gradle.properties
   org.gradle.jvmargs=-Xmx4096m
   ```

3. **Check System Resources:**
   - Ensure sufficient RAM available
   - Close unnecessary applications

4. **Disable Daemon (temporary):**
   ```powershell
   gradle build --no-daemon
   ```

---

### "Out of memory error"

**Problem:** Build runs out of memory

**Solutions:**

1. **Increase Heap Size:**
   ```properties
   # gradle.properties
   org.gradle.jvmargs=-Xmx4096m -XX:MaxMetaspaceSize=1024m
   ```

2. **Disable Parallel Execution:**
   ```properties
   # gradle.properties
   org.gradle.parallel=false
   ```

3. **Reduce Worker Count:**
   ```powershell
   gradle build --max-workers=2
   ```

4. **Close Other Applications:**
   - Free up system memory
   - Close IDEs, browsers, etc.

---

## Environment Issues

### "Permission denied"

**Problem:** Cannot write to directories

**Solutions:**

1. **Run as Administrator:**
   - Right-click PowerShell
   - Select "Run as Administrator"

2. **Check Directory Permissions:**
   ```powershell
   # Windows
   icacls "E:\Bearsampp-development\dev"
   ```

3. **Change Ownership:**
   ```powershell
   # Windows (as Administrator)
   takeown /f "E:\Bearsampp-development\dev" /r /d y
   ```

---

### "Cannot create directory"

**Problem:** Directory creation fails

**Solutions:**

1. **Check Disk Space:**
   ```powershell
   # Windows
   Get-PSDrive
   ```

2. **Check Path Length:**
   - Windows has 260 character path limit
   - Use shorter project path

3. **Check Permissions:**
   ```powershell
   gradle verify
   ```

4. **Manual Creation:**
   ```powershell
   mkdir -Force "E:\Bearsampp-development\dev\bin"
   mkdir -Force "E:\Bearsampp-development\dev\bin\lib"
   ```

---

### "File is locked"

**Problem:** Cannot delete or modify file

**Solutions:**

1. **Stop Gradle Daemon:**
   ```powershell
   gradle --stop
   ```

2. **Close IDEs:**
   - Close IntelliJ IDEA
   - Close VS Code
   - Close any file explorers

3. **Check Running Processes:**
   ```powershell
   # Windows
   Get-Process | Where-Object {$_.Path -like "*Bearsampp*"}
   ```

4. **Restart Computer:**
   - Last resort for stubborn locks

---

## Dependency Issues

### "Cannot download libraries"

**Problem:** Library download fails

**Solutions:**

1. **Check Internet Connection:**
   ```powershell
   Test-Connection google.com
   ```

2. **Check Firewall:**
   - Allow Gradle through firewall
   - Allow Java through firewall

3. **Use Proxy (if needed):**
   ```properties
   # gradle.properties
   systemProp.http.proxyHost=proxy.company.com
   systemProp.http.proxyPort=8080
   systemProp.https.proxyHost=proxy.company.com
   systemProp.https.proxyPort=8080
   ```

4. **Manual Download:**
   - Download libraries manually
   - Place in `bin/lib/` directory

5. **Retry Download:**
   ```powershell
   gradle cleanLibs loadLibs
   ```

---

### "Library verification failed"

**Problem:** Libraries are missing or corrupted

**Solutions:**

1. **Verify Libraries:**
   ```powershell
   gradle verifyLibs
   ```

2. **Re-download Libraries:**
   ```powershell
   gradle cleanLibs loadLibs
   ```

3. **Check Library Directory:**
   ```powershell
   ls "E:\Bearsampp-development\dev\bin\lib"
   ```

4. **Manual Verification:**
   - Check file sizes
   - Check file dates
   - Compare with expected files

---

## Task Execution Issues

### "Task not found"

**Problem:** Gradle cannot find specified task

**Solutions:**

1. **List Available Tasks:**
   ```powershell
   gradle tasks --all
   ```

2. **Check Task Name:**
   - Task names are case-sensitive
   - Use exact task name

3. **Verify build.gradle:**
   - Ensure task is defined
   - Check for syntax errors

---

### "Circular dependency detected"

**Problem:** Tasks depend on each other

**Solutions:**

1. **Check Task Dependencies:**
   ```powershell
   gradle tasks --all
   ```

2. **Review build.gradle:**
   - Look for circular `dependsOn` declarations
   - Fix dependency chain

3. **Use Dry Run:**
   ```powershell
   gradle build --dry-run
   ```

---

### "Task up-to-date but should run"

**Problem:** Task skipped when it shouldn't be

**Solutions:**

1. **Clean Build:**
   ```powershell
   gradle clean build
   ```

2. **Force Task Execution:**
   ```powershell
   gradle build --rerun-tasks
   ```

3. **Clear Build Cache:**
   ```powershell
   gradle clean
   rm -r .gradle/build-cache
   ```

---

## Cache Issues

### "Build cache corrupted"

**Problem:** Build cache causes errors

**Solutions:**

1. **Clear Build Cache:**
   ```powershell
   # Stop daemon
   gradle --stop
   
   # Clear cache
   rm -r .gradle/build-cache
   ```

2. **Disable Build Cache:**
   ```properties
   # gradle.properties
   org.gradle.caching=false
   ```

3. **Clean and Rebuild:**
   ```powershell
   gradle clean build
   ```

---

### "Configuration cache problems"

**Problem:** Configuration cache causes issues

**Solutions:**

1. **Disable Configuration Cache:**
   ```powershell
   gradle build --no-configuration-cache
   ```

2. **Clear Configuration Cache:**
   ```powershell
   gradle --stop
   rm -r .gradle/configuration-cache
   ```

3. **Update gradle.properties:**
   ```properties
   # gradle.properties
   # Remove or comment out:
   # org.gradle.configuration-cache=true
   ```

---

## General Troubleshooting Steps

### Complete Reset

When all else fails, perform a complete reset:

```powershell
# 1. Stop Gradle daemon
gradle --stop

# 2. Clean project
gradle clean cleanLibs

# 3. Clear Gradle cache
rm -r .gradle

# 4. Clear user Gradle cache (Windows)
rm -r $env:USERPROFILE\.gradle\caches

# 5. Reinitialize
gradle initDirs loadLibs

# 6. Verify
gradle verify

# 7. Build
gradle build
```

---

### Diagnostic Information

Collect diagnostic information for support:

```powershell
# System information
gradle --version

# Java information
java -version

# Environment check
gradle verify

# Build information
gradle info

# Task list
gradle tasks --all

# Build with full output
gradle build --info --stacktrace > build-log.txt
```

---

## Getting Help

### Built-in Help

```powershell
# General help
gradle help

# Task-specific help
gradle help --task build

# List all tasks
gradle tasks --all

# Show build info
gradle info
```

### Online Resources

- **Gradle Forums:** https://discuss.gradle.org/
- **Stack Overflow:** https://stackoverflow.com/questions/tagged/gradle
- **Gradle User Guide:** https://docs.gradle.org/current/userguide/userguide.html
- **Gradle Issue Tracker:** https://github.com/gradle/gradle/issues

### Project Documentation

- **README.md** - Project overview
- **USAGE.md** - Complete usage guide
- **TASKS.md** - Task reference

---

## Common Error Messages

### "Could not resolve all dependencies"

**Cause:** Network or repository issues

**Solution:**
```powershell
gradle build --refresh-dependencies
```

---

### "Execution failed for task"

**Cause:** Task-specific error

**Solution:**
```powershell
gradle build --stacktrace --info
```

---

### "Could not create service"

**Cause:** Gradle daemon issue

**Solution:**
```powershell
gradle --stop
gradle build
```

---

### "Unable to delete directory"

**Cause:** File locks or permissions

**Solution:**
```powershell
gradle --stop
# Close IDEs
gradle clean
```

---

**Still having issues?** Run `gradle build --scan` to generate a detailed build report.
