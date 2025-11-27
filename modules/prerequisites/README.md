# Prerequisites Module

This module builds prerequisite packages using InnoSetup and other tools from the parent dev project.

## Setup

1. First, ensure tools are downloaded in the root project:
   ```bash
   cd E:/Bearsampp-development/dev
   gradle loadLibs
   ```

2. Verify tools are available:
   ```bash
   gradle :modules:prerequisites:verifyTools
   ```

## Building

To build all prerequisite packages:
```bash
gradle :modules:prerequisites:build
```

Or from within the module directory:
```bash
cd modules/prerequisites
gradle build
```

## How It Works

The module automatically:
- Accesses InnoSetup compiler from `rootProject.ext.innosetupCompiler`
- Finds all `.iss` files in the module directory
- Compiles them using InnoSetup
- Outputs compiled installers to the build directory

## Available Tasks

- `gradle :modules:prerequisites:build` - Build all prerequisites
- `gradle :modules:prerequisites:verifyTools` - Verify required tools are available
- `gradle :modules:prerequisites:cleanModule` - Clean build artifacts
- `gradle :modules:prerequisites:initModule` - Initialize module directories

## Adding New Prerequisites

1. Create an InnoSetup script (`.iss` file) in this directory
2. Run `gradle build` - it will automatically be compiled

## Tool Paths

The module accesses these tools from the parent project:
- **InnoSetup Compiler**: `rootProject.ext.innosetupCompiler`
- **InnoSetup Path**: `rootProject.ext.innosetupPath`
- **Composer**: `rootProject.ext.composerPath`
- **InnoExtract**: `rootProject.ext.innoextractPath`

These paths are automatically configured and don't need to be hardcoded.
