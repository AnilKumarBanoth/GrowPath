from playwright.sync_api import sync_playwright, Page, expect

def run(playwright):
    browser = playwright.chromium.launch(headless=True)
    context = browser.new_context()
    page = context.new_page()

    # Go to the registration page
    page.goto("http://127.0.0.1:8000/register")

    # Fill out the registration form
    page.get_by_label("Name", exact=True).fill("Test User")
    page.get_by_label("Email").fill("test@example.com")
    page.get_by_label("Password", exact=True).fill("password")
    page.get_by_label("Confirm Password").fill("password")

    # Submit the form
    page.get_by_role("button", name="Register").click()

    # Wait for navigation to dashboard
    expect(page).to_have_url("http://127.0.0.1:8000/dashboard")

    # Navigate to the email verification page
    page.goto("http://127.0.0.1:8000/verify-email")

    # Check for the verification text
    expect(page.get_by_text("Thanks for signing up!")).to_be_visible()

    # Take a screenshot
    page.screenshot(path="jules-scratch/verification/verification.png")

    browser.close()

with sync_playwright() as playwright:
    run(playwright)