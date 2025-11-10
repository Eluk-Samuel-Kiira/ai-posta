import './bootstrap';
import { createRoot } from 'react-dom/client';
import React from 'react';

document.addEventListener('DOMContentLoaded', function() {
    const companiesApp = document.getElementById('companies-app');
    
    if (!companiesApp) {
        console.log('companies-app element not found');
        return;
    }

    // Show loading
    companiesApp.innerHTML = `
        <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading React components...</span>
            </div>
        </div>
    `;

    // Use a simple timeout to ensure everything is loaded
    setTimeout(() => {
        // Try to import the component
        import('./components/Companies/CompaniesApp.jsx')
            .then((module) => {
                console.log('CompaniesApp module loaded:', module);
                const CompaniesApp = module.default;
                const root = createRoot(companiesApp);
                // Use React.createElement to avoid JSX issues
                root.render(React.createElement(CompaniesApp));
            })
            .catch((error) => {
                console.error('Failed to load CompaniesApp:', error);
                companiesApp.innerHTML = `
                    <div class="alert alert-danger">
                        <h5>Component Loading Failed</h5>
                        <p><strong>Error:</strong> ${error.message}</p>
                        <hr>
                        <p class="mb-1"><strong>Troubleshooting steps:</strong></p>
                        <ol class="mb-0">
                            <li>Check file exists: resources/js/components/Companies/CompaniesApp.jsx</li>
                            <li>Check file has proper export</li>
                            <li>Check browser console for detailed errors</li>
                            <li>Try refreshing the page</li>
                        </ol>
                    </div>
                `;
            });
    }, 100);
});