# Bearsampp Development Kit - Gradle Build System

## Overview

The Bearsampp Development Kit uses **Pure Gradle** build system with no Ant dependencies. This provides modern build features, better performance, and improved maintainability.

## Quick Start

### Prerequisites

- ✓ Gradle 8.0+ (recommended: 9.2.0)
- ✓ Java 11+ (tested with Java 23.0.2)
- ✓ Gradle added to System PATH

### Basic Commands

```powershell
# Information
gradle tasks              # List all available tasks
gradle info               # Show build configuration
gradle verify             # Verify build environment
gradle --version          # Show Gradle version

# Build Setup
gradle initDirs           # Initialize build directories
gradle loadLibs           # Download required libraries
gradle verifyLibs         # Verify libraries are present

# Build & Clean
gradle clean              # Clean build artifacts
gradle build              # Build project
gradle release            # Create release package
gradle hashAll            # Generate hash files
gradle packageDist        # Package distribution
```

## Configuration

- **Build System:** Pure Gradle (no Ant)
- **Gradle Version:** 8.0+ (recommended 9.2.0)
- **Java Version:** 11+ (tested with 23.0.2)
- **Build Files:** 
  - `build.gradle` - Main build configuration
  - `settings.gradle` - Project settings
  - `gradle.properties` - Build properties
- **Build Cache:** Enabled
- **Configuration Cache:** Available
- **Parallel Execution:** Enabled

## Key Features

### Performance
- **Build Caching:** 2-10x faster builds after first run
- **Incremental Builds:** Only rebuilds what changed
- **Parallel Execution:** Multiple tasks run simultaneously
- **Gradle Daemon:** Keeps JVM warm for faster startup

### Modern Features
- **Configuration Cache:** Faster configuration phase
- **Dependency Management:** Automatic resolution and caching
- **Rich Plugin Ecosystem:** Extensible build system
- **Cross-Platform:** Works on Windows, Linux, macOS

### Developer Experience
- **Better IDE Support:** IntelliJ IDEA, VS Code, Eclipse
- **Improved Error Messages:** Clear and actionable
- **Build Scans:** Performance analysis and debugging
- **Task Dependencies:** Automatic task ordering

## Project Structure

```
E:/Bearsampp-development/dev/
├── build.gradle              # Main Gradle build configuration
├── settings.gradle           # Project settings
├── gradle.properties         # Build properties
├── .gradle-docs/             # Documentation
│   ├── INDEX.md             # Documentation index
│   ├── README.md            # This file (overview)
│   ├── USAGE.md             # Complete usage guide
│   ├── TASKS.md             # Task reference
│   ├── TROUBLESHOOTING.md   # Common issues and solutions
│   ├── INSTALLATION.md      # Installation guide
│   ├── MIGRATION_FROM_ANT.md # Migration notes
│   └── CONVERSION_SUMMARY.md # Conversion details
├── gradle/
│   └── wrapper/             # Gradle wrapper files
├── build/
│   └── reports/             # Build reports (generated)
├── bin/                     # Build output
├── tools/                   # Development tools
└── phpdev/                  # PHP development files
```

## Available Tasks

### Build Setup
- `initDirs` - Initialize build directories
- `loadLibs` - Download required libraries
- `cleanLibs` - Remove downloaded libraries

### Build
- `build` - Build the project
- `buildProject` - Build Bearsampp project
- `clean` - Clean build artifacts
- `release` - Create release package
- `packageDist` - Package distribution files
- `hashAll` - Generate hash files for artifacts

### Verification
- `verify` - Verify build environment
- `verifyLibs` - Verify required libraries

### Help
- `info` - Display build configuration
- `listFiles` - List project structure
- `showProps` - Show Gradle properties
- `tasks` - List all available tasks

## Advanced Usage

### Enable Configuration Cache
```powershell
gradle tasks --configuration-cache
gradle build --configuration-cache
```

### Generate Build Scan
```powershell
gradle build --scan
```

### Debug Mode
```powershell
gradle build --debug        # Full debug output
gradle build --info         # Info level output
gradle build --stacktrace   # Show stack traces
```

### Parallel Execution
```powershell
gradle build --parallel --max-workers=4
```

### Stop Gradle Daemon
```powershell
gradle --stop
```

### Refresh Dependencies
```powershell
gradle build --refresh-dependencies
```

## Build Workflow

### Standard Build
```powershell
# 1. Initialize environment
gradle initDirs

# 2. Download dependencies
gradle loadLibs

# 3. Verify setup
gradle verify

# 4. Build project
gradle build

# 5. Create release
gradle release
```

### Quick Build (after initial setup)
```powershell
gradle clean build
```

### Development Build
```powershell
# Fast incremental build
gradle build

# With verification
gradle verify build
```

## Configuration Files

### gradle.properties
Contains build configuration:
- JVM settings for Gradle daemon
- Build cache settings
- Parallel execution settings
- Project version and group

### settings.gradle
Contains project settings:
- Root project name
- Feature previews
- Build cache configuration

### build.gradle
Main build script containing:
- Project configuration
- Task definitions
- Build logic
- Helper methods

## Benefits Summary

✓ **Pure Gradle** - No Ant dependencies, modern build system  
✓ **Faster Builds** - Build cache + incremental compilation  
✓ **Better Performance** - Parallel execution and daemon  
✓ **Modern Tooling** - Better IDE support and plugins  
✓ **Maintainable** - Clear task structure and dependencies  
✓ **Extensible** - Easy to add new tasks and plugins  

## Migration from Ant

This build has been converted from a hybrid Ant/Gradle build to pure Gradle:

### What Changed
- ❌ Removed Ant build file imports
- ❌ Removed `ant-` prefixed tasks
- ✅ Added native Gradle implementations
- ✅ Improved task organization
- ✅ Better error handling
- ✅ Modern Gradle features

### What Stayed the Same
- ✅ Same project structure
- ✅ Same build outputs
- ✅ Same configuration files
- ✅ Compatible with existing workflows

## Documentation

- **README.md** - This file (overview)
- **USAGE.md** - Complete command reference
- **TASKS.md** - Detailed task documentation
- **TROUBLESHOOTING.md** - Common issues and solutions

## Support

- **Gradle User Guide:** https://docs.gradle.org/current/userguide/userguide.html
- **Gradle DSL Reference:** https://docs.gradle.org/current/dsl/
- **Gradle Forums:** https://discuss.gradle.org/

---

**Status:** ✓ Pure Gradle Build  
**Version:** 1.0.0  
**Java:** 11+ required  
**Gradle:** 8.0+ required  

**Get started with: `gradle tasks`**
