#!/bin/bash

nmap -sV -oX service.xml -p 135,139 192.168.1.14
