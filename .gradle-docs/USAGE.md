# Gradle Usage Guide

Complete reference for using Gradle with the Bearsampp Development Kit.

## Table of Contents

1. [Installation](#installation)
2. [Basic Commands](#basic-commands)
3. [Build Tasks](#build-tasks)
4. [Advanced Usage](#advanced-usage)
5. [Configuration](#configuration)
6. [Tips & Tricks](#tips--tricks)

## Installation

### Option 1: Use Gradle Wrapper (Recommended)

The project includes Gradle wrapper scripts that automatically download the correct Gradle version:

```powershell
# Windows
.\gradlew tasks

# Linux/Mac
./gradlew tasks
```

### Option 2: Install Gradle Globally

1. Download Gradle from https://gradle.org/releases/
2. Extract to a directory (e.g., `C:\Gradle`)
3. Add to PATH:
   - Windows: Add `C:\Gradle\bin` to System PATH
   - Linux/Mac: Add to `~/.bashrc` or `~/.zshrc`

4. Verify installation:
```powershell
gradle --version
```

## Basic Commands

### Information Commands

```powershell
# List all available tasks
gradle tasks

# List all tasks including internal ones
gradle tasks --all

# Show build configuration
gradle info

# Show Gradle version
gradle --version

# Show project properties
gradle showProps
```

### Build Setup Commands

```powershell
# Initialize build directories
gradle initDirs

# Download required libraries
gradle loadLibs

# Verify build environment
gradle verify

# Verify libraries are present
gradle verifyLibs

# Clean downloaded libraries
gradle cleanLibs
```

### Build Commands

```powershell
# Build the project
gradle build

# Clean build artifacts
gradle clean

# Clean and build
gradle clean build

# Create release package
gradle release

# Package distribution
gradle packageDist

# Generate hash files
gradle hashAll
```

### Help Commands

```powershell
# Show help for a specific task
gradle help --task build

# List project file structure
gradle listFiles

# Show build information
gradle info
```

## Build Tasks

### initDirs

Initialize all required build directories.

```powershell
gradle initDirs
```

**Creates:**
- `bin/` - Binary output directory
- `bin/lib/` - Library directory
- `../bearsampp-build/` - Build output directory
- `../bearsampp-build/tmp/` - Temporary files

### loadLibs

Download all required libraries and tools.

```powershell
gradle loadLibs
```

**Downloads:**
- Composer (PHP dependency manager)
- InnoExtract (Inno Setup extractor)
- HashMyFiles (File hash generator)
- LessMSI (MSI extractor)

**Options:**
```powershell
# Force re-download
gradle cleanLibs loadLibs
```

### verify

Verify that the build environment is properly configured.

```powershell
gradle verify
```

**Checks:**
- Java version (11+ required)
- Required directories exist
- PHP executable present
- 7-Zip present
- Gradle wrapper present

### build

Build the Bearsampp project.

```powershell
gradle build
```

**Process:**
1. Initialize directories
2. Verify environment
3. Compile PHP components
4. Process configuration files
5. Prepare distribution files

**Options:**
```powershell
# Build with info output
gradle build --info

# Build with debug output
gradle build --debug

# Build with stack traces
gradle build --stacktrace
```

### clean

Clean all build artifacts and temporary files.

```powershell
gradle clean
```

**Removes:**
- Build output directory
- Temporary files
- Log files
- Binary output

### release

Create a complete release package.

```powershell
gradle release
```

**Process:**
1. Clean previous build
2. Build project
3. Generate hash files
4. Create release package

**Output:**
- Release package in build directory
- Checksum file with MD5 and SHA256 hashes

### packageDist

Package the distribution files into a ZIP archive.

```powershell
gradle packageDist
```

**Creates:**
- `bearsampp-{version}.zip` in build directory

### hashAll

Generate hash files for all build artifacts.

```powershell
gradle hashAll
```

**Generates:**
- `checksums.txt` with MD5 and SHA256 hashes
- Hashes for all .zip, .exe, and .7z files

## Advanced Usage

### Configuration Cache

Speed up builds by caching configuration:

```powershell
# Enable for single build
gradle build --configuration-cache

# Enable permanently in gradle.properties
org.gradle.configuration-cache=true
```

### Build Scans

Generate detailed build performance reports:

```powershell
gradle build --scan
```

This creates a shareable URL with:
- Build performance metrics
- Task execution times
- Dependency resolution details
- Environment information

### Parallel Execution

Run tasks in parallel for faster builds:

```powershell
# Use default number of workers
gradle build --parallel

# Specify number of workers
gradle build --parallel --max-workers=4
```

### Offline Mode

Build without network access:

```powershell
gradle build --offline
```

### Refresh Dependencies

Force refresh of cached dependencies:

```powershell
gradle build --refresh-dependencies
```

### Continuous Build

Automatically rebuild when files change:

```powershell
gradle build --continuous
```

### Dry Run

See what tasks would run without executing them:

```powershell
gradle build --dry-run
```

### Profile Build

Generate build performance profile:

```powershell
gradle build --profile
```

Creates HTML report in `build/reports/profile/`

## Configuration

### gradle.properties

Configure build behavior:

```properties
# JVM settings
org.gradle.jvmargs=-Xmx2048m -XX:MaxMetaspaceSize=512m

# Enable daemon
org.gradle.daemon=true

# Enable parallel execution
org.gradle.parallel=true

# Enable build cache
org.gradle.caching=true

# Configuration cache
org.gradle.configuration-cache=true

# Console output
org.gradle.console=auto

# File encoding
systemProp.file.encoding=UTF-8

# Project properties
project.version=1.0.0
project.group=com.bearsampp
```

### settings.gradle

Configure project settings:

```groovy
rootProject.name = 'bearsampp-dev'

// Enable features
enableFeaturePreview('STABLE_CONFIGURATION_CACHE')

// Build cache
buildCache {
    local {
        enabled = true
        directory = file("${rootDir}/.gradle/build-cache")
    }
}
```

### Environment Variables

Set environment variables for builds:

```powershell
# Windows
$env:GRADLE_OPTS="-Xmx2048m"
gradle build

# Linux/Mac
export GRADLE_OPTS="-Xmx2048m"
gradle build
```

## Tips & Tricks

### Speed Up Builds

1. **Enable Daemon:**
   ```properties
   org.gradle.daemon=true
   ```

2. **Enable Parallel Execution:**
   ```properties
   org.gradle.parallel=true
   ```

3. **Enable Build Cache:**
   ```properties
   org.gradle.caching=true
   ```

4. **Use Configuration Cache:**
   ```powershell
   gradle build --configuration-cache
   ```

5. **Increase Memory:**
   ```properties
   org.gradle.jvmargs=-Xmx4096m
   ```

### Debug Build Issues

1. **Show Stack Traces:**
   ```powershell
   gradle build --stacktrace
   ```

2. **Enable Debug Output:**
   ```powershell
   gradle build --debug
   ```

3. **Show Info Output:**
   ```powershell
   gradle build --info
   ```

4. **Generate Build Scan:**
   ```powershell
   gradle build --scan
   ```

### Clean Gradle Cache

```powershell
# Stop daemon
gradle --stop

# Clean cache (Windows)
Remove-Item -Recurse -Force $env:USERPROFILE\.gradle\caches

# Clean cache (Linux/Mac)
rm -rf ~/.gradle/caches
```

### Use Gradle Wrapper

Always use the wrapper for consistent builds:

```powershell
# Windows
.\gradlew build

# Linux/Mac
./gradlew build
```

### Task Dependencies

Show task dependencies:

```powershell
gradle build --dry-run
gradle tasks --all
```

### Custom Properties

Pass properties to build:

```powershell
# Command line
gradle build -Pversion=2.0.0

# Access in build.gradle
version = project.hasProperty('version') ? project.version : '1.0.0'
```

### Multiple Tasks

Run multiple tasks in sequence:

```powershell
gradle clean build release
```

### Exclude Tasks

Skip specific tasks:

```powershell
gradle build -x test
```

## Common Workflows

### First Time Setup

```powershell
# 1. Initialize
gradle initDirs

# 2. Download dependencies
gradle loadLibs

# 3. Verify setup
gradle verify

# 4. Build
gradle build
```

### Daily Development

```powershell
# Quick build
gradle build

# Clean build
gradle clean build

# Build with verification
gradle verify build
```

### Release Process

```powershell
# 1. Clean everything
gradle clean cleanLibs

# 2. Fresh setup
gradle initDirs loadLibs

# 3. Verify
gradle verify

# 4. Create release
gradle release
```

### Troubleshooting

```powershell
# 1. Stop daemon
gradle --stop

# 2. Clean build
gradle clean

# 3. Refresh dependencies
gradle build --refresh-dependencies

# 4. Build with debug
gradle build --debug --stacktrace
```

## Getting Help

### Built-in Help

```powershell
# General help
gradle help

# Task-specific help
gradle help --task build

# List all tasks
gradle tasks --all
```

### Online Resources

- **Gradle User Guide:** https://docs.gradle.org/current/userguide/userguide.html
- **Gradle DSL Reference:** https://docs.gradle.org/current/dsl/
- **Gradle Forums:** https://discuss.gradle.org/
- **Stack Overflow:** https://stackoverflow.com/questions/tagged/gradle

### Project Documentation

- **README.md** - Project overview
- **TASKS.md** - Detailed task reference
- **TROUBLESHOOTING.md** - Common issues

---

**Need more help?** Run `gradle info` for build configuration details.
