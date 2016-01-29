# Beanstalk Job Runner

Connects to a beanstalkd instance, reads jobs, and runs them.

## Installation

`$ composer require cwramsey/beanstalk-job-runner`

## Setup

`$ mv config.ini.sample config.ini` and fill it out with your details.

To read this config, we're using (sp4ceb4r/better-ini)[https://github.com/sp4ceb4r/better-ini]. This enables some cool ini features not available with a standard `parse_ini_file` read.

## How to use

