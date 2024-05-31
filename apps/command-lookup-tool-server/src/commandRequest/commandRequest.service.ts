import { Injectable } from "@nestjs/common";
import { PrismaService } from "../prisma/prisma.service";
import { CommandRequestServiceBase } from "./base/commandRequest.service.base";

@Injectable()
export class CommandRequestService extends CommandRequestServiceBase {
  constructor(protected readonly prisma: PrismaService) {
    super(prisma);
  }
}
