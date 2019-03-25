/*

Okay, something weird happened : let Sentry prompt the user for details

*/

import * as Sentry from '@sentry/browser';

if (process.env.MIX_SENTRY_DSN != 'null') {
    Sentry.init({ dsn: process.env.MIX_SENTRY_DSN });
    window.Sentry = Sentry;
}
