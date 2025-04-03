import RPi.GPIO as gpio
from time import sleep

step_enpin = [23,25,7,12]
step_dirpin = [24,8,1,16]

gpio.setmode(gpio.BCM)
for a in range(len(step_enpin)-1):
    gpio.setup(step_enpin[a], gpio.OUT)
    gpio.setup(step_dirpin[a], gpio.OUT)
    gpio.output(step_dirpin[a],0)

try:
    while True:
        print('Direction CW')
        sleep(.5)
        gpio.output(direction_pin,cw_direction)
        for x in range(200):
            gpio.output(pulse_pin,gpio.HIGH)
            sleep(.001)
            gpio.output(pulse_pin,gpio.LOW)
            sleep(.0005)

        print('Direction CCW')
        sleep(.5)
        gpio.output(direction_pin,ccw_direction)
        for x in range(200):
            gpio.output(pulse_pin,gpio.HIGH)
            sleep(.001)
            gpio.output(pulse_pin,gpio.LOW)
            sleep(.0005)

except KeyboardInterrupt:
    gpio.cleanup()