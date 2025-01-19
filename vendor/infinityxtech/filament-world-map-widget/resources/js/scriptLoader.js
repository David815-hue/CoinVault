// scriptLoader.js

const scriptCallbacks = {};
const scriptLoaded = {};

/**
 * Checks if a script with the given URL is already injected
 * @param {string} scriptUrl - The URL of the script
 * @returns {boolean} - True if already injected, false otherwise
 */
const isScriptInjected = (scriptUrl) => {
    return document.querySelector(`script[src="${scriptUrl}"]`) !== null;
};

/**
 * Adds a callback function to the callbacks for a specific script
 * @param {string} scriptUrl - The URL of the script
 * @param {function} callback - The callback to execute when the script is loaded
 */
const addScriptCallback = (scriptUrl, callback) => {
    if (!scriptCallbacks[scriptUrl]) {
        scriptCallbacks[scriptUrl] = [];
    }
    scriptCallbacks[scriptUrl].push(callback);
};

/**
 * Runs all callbacks for a specific script
 * @param {string} scriptUrl - The URL of the script
 */
const runScriptCallbacks = (scriptUrl) => {
    if (scriptLoaded[scriptUrl]) {
        while (scriptCallbacks[scriptUrl]?.length) {
            const callback = scriptCallbacks[scriptUrl].shift();
            callback();
        }
    }
};

export const addScriptToDocument = (scriptContent) => {
    // Create a script tag with the fetched content
    const script = document.createElement('script');
    script.textContent = scriptContent;

    // Append the script to the document
    document.head.appendChild(script);
}

/**
 * Fetches the script content and injects it as an inline script tag
 * @param {string} scriptUrl - The URL of the script to load
 * @param {function} callback - The callback to execute when the script is loaded
 */
export const loadScript = (scriptUrl, callback) => {
    addScriptCallback(scriptUrl, callback);

    if (scriptLoaded[scriptUrl]) {
        runScriptCallbacks(scriptUrl);
        return;
    }

    if (!isScriptInjected(scriptUrl)) {
        fetch(scriptUrl)
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`Failed to fetch script: ${scriptUrl}`);
                }
                return response.text();
            })
            .then((scriptContent) => {
                // Add script to doc
                addScriptToDocument(scriptContent);

                // Mark the script as loaded
                scriptLoaded[scriptUrl] = true;
                runScriptCallbacks(scriptUrl);
            })
            .catch((error) => {
                console.error(`Failed to load script content: ${scriptUrl}`, {
                    error,                  // Logs the error event object for additional context
                    src: scriptUrl,         // Logs the URL of the script
                    currentTime: new Date() // Logs the time of the error for debugging purposes
                });
            });
    }
};
