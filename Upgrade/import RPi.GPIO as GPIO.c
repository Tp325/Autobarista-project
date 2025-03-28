#include <iostream>
#include <wiringPi.h>
#include <softPwm.h>
#include <unistd.h> // For usleep

using namespace std;

const int pwm_pins[] = {18, 23, 24, 25};
const int num_pins = sizeof(pwm_pins) / sizeof(pwm_pins[0]);
const int pwm_frequency = 70000; // Not directly used with softPwm, but important for calculations
const int pwm_range = 100; // Range for softPwm (0-100)

int main() {
    if (wiringPiSetupGpio() == -1) {
        cerr << "wiringPi setup failed!" << endl;
        return 1;
    }

    int softPwm_pins[num_pins]; // Array to store the softPwm pin numbers

    for (int i = 0; i < num_pins; i++) {
        // Initialize softPwm on each pin.  Note the range.
        softPwm_pins[i] = softPwmCreate(pwm_pins[i], 0, pwm_range); // Initial value 0, range 0-100

        if (softPwm_pins[i] == -1) {
          cerr << "softPwm creation failed for pin " << pwm_pins[i] << endl;
          return 1;
        }
    }

    try {
        while (true) {
            // Example: Vary duty cycles
            softPwmWrite(softPwm_pins[0], 25); // 25% duty cycle on pin 18
            softPwmWrite(softPwm_pins[1], 50); // 50% duty cycle on pin 23
            softPwmWrite(softPwm_pins[2], 75); // 75% duty cycle on pin 24
            softPwmWrite(softPwm_pins[3], 100); // 100% duty cycle on pin 25

            // IMPORTANT:  No delay is needed at 70kHz with softPwm.  Adding a delay here will slow down the PWM frequency.
            // If you need *any* delay, it needs to be *extremely* short (microseconds) at these frequencies.

        }
    } catch (const std::exception& e) {
        cerr << "Exception caught: " << e.what() << endl;
    }

    // It's very unlikely the program will ever get here because of the infinite loop,
    // but it's good practice to have cleanup code.
    for (int i = 0; i < num_pins; i++) {
        softPwmStop(pwm_pins[i]); // Stop the softPwm thread for each pin.
    }

    return 0;
}