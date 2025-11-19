# Gradle Tasks Reference

Complete reference for all available Gradle tasks in the Bearsampp Development Kit.

## Table of Contents

1. [Build Setup Tasks](#build-setup-tasks)
2. [Build Tasks](#build-tasks)
3. [Verification Tasks](#verification-tasks)
4. [Help Tasks](#help-tasks)
5. [Task Dependencies](#task-dependencies)

## Build Setup Tasks

### initDirs

**Group:** build setup  
**Description:** Initialize build directories

**Usage:**
```powershell
gradle initDirs
```

**What it does:**
- Creates `bin/` directory for binary output
- Creates `bin/lib/` directory for libraries
- Creates `../bearsampp-build/` directory for build output
- Creates `../bearsampp-build/tmp/` directory for temporary files

**Output:**
```
✓ Build directories initialized
  - Bin: E:/Bearsampp-development/dev/bin
  - Lib: E:/Bearsampp-development/dev/bin/lib
  - Build: E:/Bearsampp-development/bearsampp-build
  - Tmp: E:/Bearsampp-development/bearsampp-build/tmp
```

**Dependencies:** None

**When to use:**
- First time project setup
- After cleaning all directories
- When directories are accidentally deleted

---

### loadLibs

**Group:** build setup  
**Description:** Download required libraries and tools

**Usage:**
```powershell
gradle loadLibs
```

**What it does:**
- Downloads Composer (PHP dependency manager)
- Downloads InnoExtract (Inno Setup extractor)
- Downloads HashMyFiles (file hash generator)
- Downloads LessMSI (MSI extractor)
- Extracts ZIP archives automatically
- Skips already downloaded files

**Output:**
```
Downloading required libraries...
  Downloading composer...
  ✓ composer downloaded
  Downloading innoextract...
  ✓ innoextract downloaded
  Extracting innoextract-1.9-windows.zip...
  ✓ innoextract extracted
  ...
✓ All libraries processed
```

**Dependencies:** 
- `initDirs` (automatically runs first)

**When to use:**
- First time project setup
- After running `cleanLibs`
- When libraries are missing or corrupted

**Notes:**
- Downloads are cached - won't re-download existing files
- Requires internet connection
- Files are saved to `bin/lib/` directory

---

### cleanLibs

**Group:** build setup  
**Description:** Remove downloaded libraries

**Usage:**
```powershell
gradle cleanLibs
```

**What it does:**
- Deletes the entire `bin/lib/` directory
- Removes all downloaded libraries and tools

**Output:**
```
✓ Libraries cleaned
```

**Dependencies:** None

**When to use:**
- Before fresh library download
- To free up disk space
- When libraries are corrupted
- Before release to ensure clean state

**Warning:** This will delete all downloaded libraries. Run `loadLibs` afterwards to restore them.

---

## Build Tasks

### build

**Group:** build  
**Description:** Build the Bearsampp project

**Usage:**
```powershell
gradle build
```

**What it does:**
- Runs `buildProject` task
- Compiles PHP components
- Processes configuration files
- Prepares distribution files

**Output:**
```
Building Bearsampp project...
  - Compiling PHP components...
  - Processing configuration files...
  - Preparing distribution files...
✓ Build completed successfully
```

**Dependencies:**
- `buildProject`
- `initDirs` (via buildProject)
- `verify` (via buildProject)

**When to use:**
- Standard project build
- After making code changes
- Before creating release

**Options:**
```powershell
# Build with info output
gradle build --info

# Build with debug output
gradle build --debug

# Build with configuration cache
gradle build --configuration-cache

# Build in parallel
gradle build --parallel
```

---

### buildProject

**Group:** build  
**Description:** Build the Bearsampp project (internal task)

**Usage:**
```powershell
gradle buildProject
```

**What it does:**
- Initializes directories
- Verifies environment
- Builds project components

**Dependencies:**
- `initDirs`
- `verify`

**When to use:**
- Called automatically by `build` task
- Can be called directly for custom workflows

---

### clean

**Group:** build  
**Description:** Clean build artifacts and temporary files

**Usage:**
```powershell
gradle clean
```

**What it does:**
- Deletes `../bearsampp-build/tmp/` directory
- Deletes `bin/` directory
- Removes all `.tmp` files
- Removes all `.log` files

**Output:**
```
✓ Build artifacts cleaned
```

**Dependencies:** None

**When to use:**
- Before fresh build
- To free up disk space
- When build artifacts are corrupted
- Before creating release

**Common patterns:**
```powershell
# Clean and build
gradle clean build

# Clean everything
gradle clean cleanLibs
```

---

### release

**Group:** build  
**Description:** Create release package

**Usage:**
```powershell
gradle release
```

**What it does:**
- Cleans previous build artifacts
- Builds the project
- Generates hash files
- Creates release package

**Output:**
```
╔═════════════════════════════════════════════════════��══════════╗
║                    Release Package Created                     ║
╚════════════════════════════════════════════════════════════════╝

Version:     1.0.0
Build Path:  E:/Bearsampp-development/bearsampp-build

Next steps:
  1. Review the build artifacts in E:/Bearsampp-development/bearsampp-build
  2. Test the release package
  3. Verify checksums in checksums.txt
  4. Deploy to distribution channels
```

**Dependencies:**
- `clean`
- `buildProject`
- `hashAll`

**When to use:**
- Creating official release
- Before distribution
- For testing complete build process

**Notes:**
- Always starts with clean build
- Generates checksums automatically
- Creates production-ready package

---

### packageDist

**Group:** build  
**Description:** Package the distribution files

**Usage:**
```powershell
gradle packageDist
```

**What it does:**
- Creates ZIP archive of bin directory
- Names file as `bearsampp-{version}.zip`
- Saves to build directory

**Output:**
```
Packaging distribution...
✓ Distribution packaged: bearsampp-1.0.0.zip
  Size: 45.23 MB
```

**Dependencies:**
- `buildProject`

**When to use:**
- After successful build
- To create distributable package
- For archiving builds

---

### hashAll

**Group:** build  
**Description:** Generate hash files for all build artifacts

**Usage:**
```powershell
gradle hashAll
```

**What it does:**
- Scans build directory for artifacts (.zip, .exe, .7z)
- Calculates MD5 hash for each file
- Calculates SHA256 hash for each file
- Creates `checksums.txt` with all hashes

**Output:**
```
Generating hash files...
  ✓ bearsampp-1.0.0.zip
  ✓ setup.exe
✓ Hash files generated: E:/Bearsampp-development/bearsampp-build/checksums.txt
```

**Dependencies:** None

**When to use:**
- After creating release package
- For verifying file integrity
- Before distribution

**Output format (checksums.txt):**
```
# Bearsampp Build Checksums
# Generated: Wed Nov 13 22:52:00 UTC 2024

bearsampp-1.0.0.zip
  MD5:    a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6
  SHA256: 1234567890abcdef1234567890abcdef1234567890abcdef1234567890abcdef
```

---

## Verification Tasks

### verify

**Group:** verification  
**Description:** Verify build environment and dependencies

**Usage:**
```powershell
gradle verify
```

**What it does:**
- Checks Java version (11+ required)
- Verifies required directories exist
- Checks for PHP executable
- Checks for 7-Zip
- Checks for Gradle wrapper

**Output:**
```
Verifying build environment...

Environment Check Results:
────────────────────────────────────────────────────────────
  ✓ PASS     Java 11+
  ✓ PASS     Dev directory
  ✓ PASS     Tools directory
  ✓ PASS     PHPDev directory
  ✓ PASS     PHP executable
  ✓ PASS     7-Zip
  ✓ PASS     Gradle wrapper
────────────────────────────────────────────────────────────

✓ All checks passed! Build environment is ready.
```

**Dependencies:** None

**When to use:**
- First time setup
- After system changes
- Troubleshooting build issues
- Before starting development

**Failure output:**
```
⚠ Some checks failed. Please review the requirements.

To fix missing components:
  - Run 'gradle loadLibs' to download required libraries
  - Ensure PHP and 7-Zip are installed in tools directory
```

---

### verifyLibs

**Group:** verification  
**Description:** Verify that all required libraries are present

**Usage:**
```powershell
gradle verifyLibs
```

**What it does:**
- Checks for composer.phar
- Checks for innoextract
- Checks for hashmyfiles
- Checks for lessmsi

**Output:**
```
Verifying libraries...
  ✓ composer.phar
  ✓ innoextract
  ✓ hashmyfiles
  ✓ lessmsi

✓ All required libraries are present
```

**Dependencies:** None

**When to use:**
- After running `loadLibs`
- Troubleshooting build issues
- Before starting build

**Failure output:**
```
⚠ Missing libraries: composer.phar, innoextract
Run 'gradle loadLibs' to download missing libraries
```

---

## Help Tasks

### info

**Group:** help  
**Description:** Display build configuration information

**Usage:**
```powershell
gradle info
```

**What it does:**
- Shows project information
- Shows all configured paths
- Shows Java information
- Shows Gradle information
- Shows system information
- Lists available task groups

**Output:**
```
╔════════════════════════════════════════════════════════════════╗
║           Bearsampp Development Kit - Build Info               ║
╚════════════════════════════════════════════════════════════════╝

Project:        bearsampp-dev
Version:        1.0.0
Description:    Bearsampp Development Kit
Group:          com.bearsampp

Paths:
  Dev Path:     E:/Bearsampp-development/dev
  Build Path:   E:/Bearsampp-development/bearsampp-build
  Bin Path:     E:/Bearsampp-development/dev/bin
  Lib Path:     E:/Bearsampp-development/dev/bin/lib
  Tools Path:   E:/Bearsampp-development/dev/tools
  PHPDev Path:  E:/Bearsampp-development/dev/phpdev
  Tmp Path:     E:/Bearsampp-development/bearsampp-build/tmp

Java:
  Version:      23.0.2
  Home:         C:\Program Files\Java\jdk-23
  Vendor:       Oracle Corporation

Gradle:
  Version:      9.2.0
  Home:         C:\Gradle

System:
  OS:           Windows 11
  Architecture: amd64
  User:         bear

Available Task Groups:
  • build setup  - Initialize and configure build environment
  • build        - Build and package tasks
  • verification - Verify build environment and artifacts
  • help         - Help and information tasks

Quick Start:
  gradle tasks --all     - List all available tasks
  gradle info            - Show this information
  gradle loadLibs        - Download required libraries
  gradle verify          - Verify build environment
  gradle build           - Build the project
  gradle release         - Create release package
```

**Dependencies:** None

**When to use:**
- Getting familiar with project
- Checking configuration
- Troubleshooting path issues
- Documentation reference

---

### listFiles

**Group:** help  
**Description:** List project file structure

**Usage:**
```powershell
gradle listFiles
```

**What it does:**
- Lists all files in project
- Shows directory structure
- Excludes .git, .gradle, build, bin directories

**Output:**
```
Project Structure:
────────────────────────────────────────────────────────────
build.gradle
settings.gradle
gradle.properties
gradlew
gradlew.bat
  gradle-wrapper.properties
  gradle-wrapper.jar
README.md
...
```

**Dependencies:** None

**When to use:**
- Understanding project structure
- Finding files
- Documentation

---

### showProps

**Group:** help  
**Description:** Show all Gradle properties

**Usage:**
```powershell
gradle showProps
```

**What it does:**
- Lists all project properties
- Shows configured values
- Excludes internal Gradle properties

**Output:**
```
Gradle Properties:
────────────────────────────────────────────────────────────
  binPath                        = E:/Bearsampp-development/dev/bin
  buildPath                      = E:/Bearsampp-development/bearsampp-build
  description                    = Bearsampp Development Kit
  devPath                        = E:/Bearsampp-development/dev
  group                          = com.bearsampp
  libPath                        = E:/Bearsampp-development/dev/bin/lib
  name                           = bearsampp-dev
  phpdevPath                     = E:/Bearsampp-development/dev/phpdev
  project.group                  = com.bearsampp
  project.version                = 1.0.0
  tmpPath                        = E:/Bearsampp-development/bearsampp-build/tmp
  toolsPath                      = E:/Bearsampp-development/dev/tools
  version                        = 1.0.0
```

**Dependencies:** None

**When to use:**
- Debugging configuration
- Understanding available properties
- Custom task development

---

### tasks

**Group:** help  
**Description:** List all available tasks

**Usage:**
```powershell
# List main tasks
gradle tasks

# List all tasks including internal
gradle tasks --all

# List tasks in specific group
gradle tasks --group build
```

**Output:**
```
Build setup tasks
-----------------
cleanLibs - Remove downloaded libraries
initDirs - Initialize build directories
loadLibs - Download required libraries and tools

Build tasks
-----------
build - Build the Bearsampp project
buildProject - Build Bearsampp project
clean - Clean build artifacts and temporary files
hashAll - Generate hash files for all build artifacts
packageDist - Package the distribution files
release - Create release package

Verification tasks
------------------
verify - Verify build environment and dependencies
verifyLibs - Verify that all required libraries are present

Help tasks
----------
info - Display build configuration information
listFiles - List project file structure
showProps - Show all Gradle properties
tasks - List all available tasks
```

**Dependencies:** None

**When to use:**
- Discovering available tasks
- Learning task organization
- Finding specific tasks

---

## Task Dependencies

### Dependency Graph

```
release
├── clean
├── buildProject
│   ├── initDirs
│   └── verify
└── hashAll

build
└── buildProject
    ├── initDirs
    └── verify

packageDist
└── buildProject
    ├── initDirs
    └── verify

loadLibs
└── initDirs
```

### Execution Order

When you run `gradle release`, tasks execute in this order:

1. `clean` - Clean previous build
2. `initDirs` - Initialize directories
3. `verify` - Verify environment
4. `buildProject` - Build project
5. `hashAll` - Generate hashes

### Task Relationships

| Task         | Depends On               | Depended By                  |
|--------------|--------------------------|------------------------------|
| initDirs     | -                        | loadLibs, buildProject       |
| loadLibs     | initDirs                 | -                            |
| verify       | -                        | buildProject                 |
| buildProject | initDirs, verify         | build, packageDist, release  |
| build        | buildProject             | -                            |
| clean        | -                        | release                      |
| hashAll      | -                        | release                      |
| release      | clean, buildProject, hashAll | -                        |
| packageDist  | buildProject             | -                            |

---

## Task Options

### Common Options

All tasks support these Gradle options:

```powershell
# Output control
--quiet, -q          # Quiet output
--info, -i           # Info output
--debug, -d          # Debug output
--stacktrace, -s     # Show stack traces
--full-stacktrace    # Show full stack traces

# Performance
--parallel           # Parallel execution
--max-workers=N      # Set worker count
--configuration-cache # Use configuration cache
--build-cache        # Use build cache

# Behavior
--dry-run, -m        # Dry run (don't execute)
--continue           # Continue after failure
--offline            # Offline mode
--refresh-dependencies # Refresh dependencies

# Analysis
--scan               # Generate build scan
--profile            # Generate profile report
```

### Examples

```powershell
# Build with info output
gradle build --info

# Build in parallel with 4 workers
gradle build --parallel --max-workers=4

# Dry run to see task order
gradle release --dry-run

# Build with configuration cache
gradle build --configuration-cache

# Generate build scan
gradle build --scan
```

---

**For more information, run:** `gradle help --task <taskname>`
