var logoreport = 'data:image/png;base64,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'