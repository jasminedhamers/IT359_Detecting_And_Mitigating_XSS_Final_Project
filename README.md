# Cross-Site Scripting (XSS) Vulnerability Analysis and Mitigation

## Video Presentation

[insert video link here]

---

## Project Purpose

This project addresses a critical security challenge by developing hands-on experience in identifying, exploiting, and mitigating Cross-Site Scripting (XSS) vulnerabilities. XSS occurs when an attacker injects malicious client-side scripts, often resulting in session hijacking or the theft of sensitive information.

The project's scope included:
* **Lab Setup:** Using Burp Suite and the bWAPP platform in a Windows 11 virtual machine.
* **Exploitation:** Carrying out effective attacks against Stored and Reflected XSS.
* **Mitigation:** Implementing and testing countermeasures such as Content Security Policy (CSP), output encoding, and server-side input validation.

---

## Project Dependencies and Required Tools

This project utilizes a penetration testing lab environment. The following core tools and platforms are required to replicate the setup and execution:

* **Virtual Environment:** A Windows 11 Virtual Machine or similar isolated host environment.
* **Web Server:** XAMPP was installed to provide the necessary Apache and MySQL services to host the vulnerable application.
* **Vulnerable Application:** bWAPP (Bee-box Web Application) was used as the purposely vulnerable target.
* **Interception Proxy:** Burp Suite Community Edition was configured as an HTTP proxy to intercept, analyze, and modify payload requests.

---

## Setup and Execution Instructions

The project follows a structured, hands-on penetration testing process.

### Lab Environment Setup

1. **VM Setup:** Start your virtual machine (VM).
2. **Web Server Installation:** Install and configure XAMPP inside the VM.
3. **Target Application:** Install and configure bWAPP on the XAMPP server.
4. **Proxy Configuration:** Install Burp Suite and configure the browser within the VM to use Burp Suite as an HTTP proxy.

### Exploitation Procedure

This section details the steps used to successfully exploit both Reflected and Stored XSS vulnerabilities in the bWAPP application at a low-security level. 

#### Reflected XSS Exploitation 

1.  **Select Challenge:** In bWAPP, select the Reflected XSS challenge. 
2.  **Test Input & Intercept:** Enter benign test input (for example, firstname = "Hello", lastname = "World"). Intercept the resulting GET request in Burp Suite. 
3. **Confirm Reflection:** Modify the input in Burp Suite (for instance, change "Hello" to "test"). Review the server's response to confirm the modified input was reflected directly into the HTML body without encoding, identifying the injection point. 
4.**Execution:** Forward the modified request to the application. The changed firstname and lastname values will appear in the returned webpage, confirming the vulnerability and demonstrating the injection point.

#### Stored XSS Exploitation 

1.  **Select Challenge:** In bWAPP, select the Stored XSS challenge (for example, the blog entry page). 
2.  **Intercept Request:** Begin a new blog entry but do not submit it. Ensure Burp Suite is actively intercepting the resulting POST request. 
3.  **Payload Injection:** Modify the request in Burp Suite, replacing the blog entry content with the malicious script payload (for example, “<script>alert('Stored XSS');</script>”). 
4.  **Execution:** Forward the modified request. When you or any other user subsequently views the affected page, the stored script will load and execute, confirming the more severe Stored XSS vulnerability.

### Mitigation and Testing

Mitigation was implemented using a multi-layered, defense-in-depth approach, with all custom implementation files located within the “src/mitigation/” directory. 

**Input Validation (Server-Side):** 
* **File Reference:** src/mitigation/xss_input_filter.php 
* **Function:** This script implements server-side filtering to sanitize or reject hostile user input before it is processed by the application. 

**Output Encoding:** 
* **File Reference:** src/mitigation/xss_output_encoder.php
* **Function:** All dynamic, user-controlled data is passed through this function prior to being rendered in the browser, neutralizing the data by converting special characters (like `<`, `>`, and `/`) into their HTML entity equivalents. 

**Content Security Policy (CSP):** 
* **Configuration Reference:** Server configuration via an .htaccess file (or equivalent). 
* **Function:** A restrictive CSP header was configured to whitelist trusted sources for scripts and styles, providing a final layer of defense at the browser level against unauthorized code execution. 

**Testing:** 
* **Activation:** To activate the mitigation, the files/configurations must be deployed onto the bWAPP application environment. 
* **Re-Test:** Repeat both the Reflected and Stored XSS exploitation procedures against the mitigated application. Successful mitigation is confirmed when the malicious payloads are either rejected by the input validation or rendered harmlessly as text due to output encoding.

---

## Usage Guide with Examples

The primary usage of this project is demonstrated through the penetration testing methodology detailed in the Setup and Execution Instructions section. 

This methodology serves as the practical example of both vulnerability discovery and successful mitigation testing.

---

## Repository Structure

* **README.md**: Project documentation, setup guide, and link to the video presentation.
* **.gitignore**: Specifies files and directories to be ignored by Git (for example, virtual environment files).
* **requirements.txt**: Lists the required software dependencies and tools for the lab environment.
* **src/**: Contains all source code, including the mitigation scripts.
* **report/**: Contains Cross-Site Scripting (XSS) Vulnerability Analysis and Mitigation Writeup.pdf: The complete 5-7 page final report in PDF format.


