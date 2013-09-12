#!/usr/bin/env ruby

# change to script
Dir.chdir File.expand_path(File.dirname(__FILE__))

# check if dependencies need to be installed
Kernel.exec('sh tools/cleanup');
