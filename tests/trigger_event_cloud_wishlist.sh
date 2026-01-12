#!/bin/bash
set -eu

gcloud pubsub topics publish oml-event --message='{"command": "batch-update-wishlist"}'
